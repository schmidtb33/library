<?php

class BookWidgetController extends LibraryController  {

    /**
     * list all books that are not lended
     * @return html option list of books that are available
     */
    public function actionGetList()
    {
        $data = Book::model()->findAll();
        echo CHtml::tag('option',
            array('value' => ''), CHtml::encode("Choose a book"), true);
        foreach ($data as $item)
        {
            echo CHtml::tag('option',
                array('value' => $item->id), CHtml::encode($item->getTitle()), true);
        }
    }

    /**
     * lend book for user
     * @param integer $id the ID of the book to be lended
     * @param integer $userId the ID of the user that lends the book
     * @return success message
     * @throws CHttpException
     */
    public function actionAdd(){
        $id = $_POST['id'];
        $userId = $_POST['userId'];

        $model = $this->loadModel($id);
        $user = User::model()->findByPk($userId);

        // if book available and user has not reached max number of books -> lend book
        if($model->available() && $user->allowed())
        {
            $userHasBook = new UserHasBook();
            $userHasBook->user_id = $userId;
            $userHasBook->book_id = $id;
            if($userHasBook->save()){
                Helper::ajaxSuccess('Book has been lended');
            } else
            {
                Yii::log('actionAdd - could not save','error');
                Helper::handleDatabaseError($userHasBook);
            }
        } else{
            Yii::log('actionAdd - not allowed','info');
        }
        Helper::ajaxError('You cannot lend the book');
    }

    /**
     * remove book for user
     * @param integer $id the ID of the model to be deleted
     * @return success message
     * @throws CHttpException
     */
    public function actionRemove(){
        $id = $_POST['id'];

        $model = UserHasBook::model()->findByPk($id);
        // if book available and user has not reached max number of books -> lend book
        if($model->delete())
        {
                Helper::ajaxSuccess('Book has been removed');
        } else{
            Yii::log('actionRemove - not allowed','info');
        }
        Helper::ajaxError('Book could not be removed');
    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Book the loaded model
     * @throws CHttpException
     */
    private function loadModel($id){
        $model = Book::model()->findByPk($id);
        if($model){
            return $model;
        }
        else
        {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
}