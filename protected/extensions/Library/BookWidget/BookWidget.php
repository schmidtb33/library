<?php
class BookWidget extends LibraryAbstract   {

    public function run(){
        Yii::log('BookWidget->run()','info');
        $this->loadAssets();
        $users = User::model()->findAll();
        $this->render('list',array(
            'data'=>$users,
        ));
    }

    public function loadAssets(){
        $baseUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.Library.BookWidget.assets'), $hashByName = false, $level = -1, YII_DEBUG);
        $cs = Yii::app()->clientScript;
        $cs->registerCssFile($baseUrl . '/css/library.css');
        $cs->registerScriptFile($baseUrl . '/js/BookWidget.js');
    }
}