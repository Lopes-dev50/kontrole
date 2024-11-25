<?php

namespace App\Classes;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class Logger{


    public function Log($level, $message){

         $r = Auth::user()->email;

             $message = '[' . $r . '] - ' . $message;


        Log::channel('main')->$level($message);

    }



}
