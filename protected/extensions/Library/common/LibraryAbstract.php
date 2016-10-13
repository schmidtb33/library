<?php
abstract class LibraryAbstract extends CWidget{

    protected function checkIfIsClass($object, $className){
        if($object){
            if(get_class($object) != $className){
                throw new Exception("not a $className:".get_class($object));
            }
        }
    }
}