<?php

namespace App\Services;

class ResponseService
{
    public static function SuccessResponse($msg = "Successfully Done.")
    {
        return ["status" => "success", "message" => "Successfully Done."];
    }

    public static function ErrorResponse($msg = "Error Occures!")
    {
        return ["status" => "danger", "message" => "Error Occures. Please try again."];
    }
}
