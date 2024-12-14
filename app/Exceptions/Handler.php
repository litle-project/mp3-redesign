<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// use Telegram\Bot\Laravel\Facades\Telegram;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // public function render($request, Throwable $exception)
    // {

    //     if(env('APP_DEBUG')){
    //         return parent::render($request, $exception);
    //     }else{

    //         if($exception->getMessage() != 'Unauthenticated.'){
    //             Telegram::sendMessage([
    //                 'chat_id' => '-1001717995921',
    //                 'parse_mode' => 'HTML',
    //                 'text' => "MP3 " . date('Y-m-d H:i:s') .
    //                 "\n <strong> Message</strong>  : " . $exception->getMessage() .
    //                     "\n <strong> File</strong>  : " . $exception->getFile() .
    //                     "\n <strong> Line</strong>  : " . $exception->getLine() .
    //                     "\n <strong> Link</strong>  : " .  url()->current()
    //             ]);
    //         }
            
    //         return parent::render($request, $exception);
    //     }

    // }
}
