<?php
/* @var $data user[] */
?>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<table>
<?php
foreach ($data as $model)
{
    $this->render('_view', array('data'=>$model));
}
?>
</table>
<select id="bookList" name="choose" style=display:none;"">
</select>