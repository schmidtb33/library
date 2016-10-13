<?php

/**
 * Created by PhpStorm.
 * User: arbeit
 * Date: 2016-09-13
 * Time: 13:45
 */
class Helper
{
    public static function ajaxSuccess($message = "success")
    {
        echo $message;
        Yii::app()->end();
    }

    public static function ajaxError($message = "error")
    {
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json');
        echo ($message);
        Yii::app()->end();
    }

    public static function handleDatabaseError($activeRecord)
    {
        Yii::log(self::errorsToString($activeRecord->getErrors()),"error");
        self::dumpOwn($activeRecord->getErrors());
    }

    public static function dumpOwn($var)
    {
        echo "<pre><div align='left'>";
        print_r($var);
        echo "</div></pre>";
    }

    public static function errorsToString($errors)
    {
        if (is_array($errors))
        {
            $errorString = "";
            foreach ($errors as $errorMessage => $error)
            {
                $errorString .= $errorMessage . ": ";
                foreach ($error as $usermessage)
                {
                    $errorString .= $usermessage;
                }
                $errorString .= "\n\r";
            }
            return $errorString;
        }
        else
        {
            return $errors;
        }
    }
}