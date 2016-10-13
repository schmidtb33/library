<?php

class LibraryController extends CExtController{

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            /*'postOnly', // we only allow  POST request*/

        );
    }

    public function accessRules()
    {

        return array(
            array('allow',
                'users'=>array('@'), //logged-in users only
            ),
            array('deny',  // deny all users
                'users'=>array('*'),

            ),
        );
    }

    public function performAjaxValidation($model, $form_name)
    {
        if(isset($_POST['ajax']) && ($_POST['ajax']===$form_name  || stristr( $_POST['ajax'], $form_name)))
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}