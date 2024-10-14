<?php

namespace App\Helper;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Exception
{
    public static function handle($th)
    {
        $message = $th->getMessage();

        if ($th instanceof NotFoundHttpException) {
            return redirect()->back()->with('error', $message);
        } else {
            return redirect()->back()->with('error', 'Something went wrong..');
        }
    }
}
