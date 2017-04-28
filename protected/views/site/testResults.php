<?php
//Yii::import('ext.yexcel.Yexcel');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$fileExtension = 'xls';
$file_path = Yii::app()->yexcel->importFile . '.' . $fileExtension;
$sheet_array = Yii::app()->yexcel->readActiveSheet($file_path);
?>
<div id="pageContainer" class="container">
    <div class="subContainer">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <h1><?php echo Yii::t('youtoo', 'Welcome') ?></h1>
                <table class="table table-bordered">
                    <col width="30%">
                    <thead>
                        <tr>
<?php
echo "<table>";

foreach ($sheet_array as $row) {
    echo "<tr>";
    foreach ($row as $column)var_dump($column);exit;
        echo "<td>$column</td>";
    echo "</tr>";
}

echo "</table>";
?>
                </p>
            </div>
        </div>
    </div>
</div>