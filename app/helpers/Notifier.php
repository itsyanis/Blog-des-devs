<?php

namespace App\helpers;

Class Notifier 
{
    public $type;
    public $msg;
    public $callback;
    public $callbackArgs;

    public function __construct($type,$msg,$callback,$callbackArgs)
    {
        $this->type = $type;
        $this->msg = $msg;
        $this->callback = $callback;
        $this->callbackArgs = $callbackArgs;
    }

    public function toJson()
    {
        return response()->json([
           
            'notification' =>[
                    'type' => $this->type,
                    'message' => $this->msg,
            ],
            
            'callback' => [
                 'functionName' => $this->callback,
                 'args' => $this->callbackArgs,
            ]
        ]);
    }
}