
<?php
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('jquery', CClientScript::POS_END);
?>

<style type="text/css">
    .message {
        margin: 150px 0px 150px 0px;
        font-size: 25px;
        text-align: center;
        color: #5C5E5B;
    }

    .game {
        margin: 50px 0px 50px 0px;
        direction: ltr;
        text-align: center;
    }

    .game .question {
        margin: 0px 0px 30px 0px;
        font-size: 38px;
        text-align: center;
        font-weight: bold;
        color: #df9721;
    }

    .game .description {
        font-size: 16px;
        font-weight: 200;
        line-height: 1.4;
        margin-bottom: 20px;
    }

    .game .options {
        color: #ffffff;
        font-size: 20px;
        display:inline-block;
        margin: 10px auto;
        text-align: left;
    }

    .game .submit_button {
        margin: 50px 0px 0px 0px;
        text-align: center;
    }
    
    #countdown {
        color: #8F090A;
        font-size: 25px;
        font-weight: bold;
    }
</style>

<div id="pageContainer" class="container">
    <div class="form">
        <div class="game" class="fab-left fab-voting-left">
            <div>All games played, games will restart at midnight.</div>
    </div>
</div>
