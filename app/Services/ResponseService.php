<?php

namespace App\Services;

class ResponseService
{

    protected  $status;
    public static function SuccessResponse($msg = "Successfully Done.")
    {
        //ResponseService::$status = "success";
        return "Done Successfully.";
    }

    public static function ErrorResponse($msg = "Error Occures!")
    {
        //ResponseService::$status = "danger";
        return " Error Occures. Please try again.";
    }

    public static function getStatus()
    {
        return ResponseService::$status;
    }
}
