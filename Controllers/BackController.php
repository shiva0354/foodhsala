<?php

namespace Controllers;

class BackController
{

    public static function goBack(array $error)
    {
        $referer = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);
        $_SESSION['error'] = $error;

        if (!empty($referer)) {
            header("Location:$referer");
            exit();
        } else {
            echo '<p><a href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a></p>';
        }
    }

    public static function success(string $success)
    {
        $referer = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);
        $_SESSION['success'] = $success;

        if (!empty($referer)) {
            header("Location:$referer");
            exit();
        } else {
            echo '<p><a href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a></p>';
        }
    }
}
