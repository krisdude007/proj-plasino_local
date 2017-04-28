<?php
class clientTickerController extends TickerController {
    public $activeNavLink;

    public function actionIndex($id=0) {
        $this->activeNavLink = 'ticker';
        if (!(!empty(Yii::app()->session['type']) && !empty(Yii::app()->session['prize_id']) && !empty(Yii::app()->session['credits']))) {
            $this->redirect($this->createUrl('/playnow'));
        }
        $model = new eTicker;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ticker-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['eTicker'])) {
            $model->attributes = $_POST['eTicker'];
            $model->prize_id = Yii::app()->session['prize_id'];
            $model->question_id = Yii::app()->session['question_id'];
            $model->type = 'ticker';
            $model->user_id = Yii::app()->user->getId();
            $model->to_web = 1;
            $model->arbitrator_id = Yii::app()->user->getId();
            $model->to_facebook = 0;
            $model->to_twitter = 0;

            $model2 = new eCreditTransaction;
            $model2->type = Yii::app()->session['type'];
            $model2->prize_id = Yii::app()->session['prize_id'];
            $model2->credits = Yii::app()->session['credits'];

            $transaction = Yii::app()->db->beginTransaction();
            try {
                if (!$model->save()) {
                    throw new Exception('Ticker cannot be saved.');
                }
                if (!$model2->save()) {
                    throw new Exception('Credit cannot be saved.');
                }
                $transaction->commit();
            }
            catch (Exception $e) {
                $transaction->rollBack();
                $this->render('index', array(
                    'model' => $model,
                ));
                return;
            }
            
            $prize = ePrize::model()->findByPk(Yii::app()->session['prize_id']);
            $prize->quantity = $prize->quantity - 1;
            $prize->save();

            unset(Yii::app()->session['type']);
            unset(Yii::app()->session['prize_id']);
            unset(Yii::app()->session['credits']);
            unset(Yii::app()->session['question_id']);
            $this->redirect($this->createUrl('/ticker/thanks'));
        }
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionThanks() {
        $this->render('thanks', array(
        ));
    }
}
?>
