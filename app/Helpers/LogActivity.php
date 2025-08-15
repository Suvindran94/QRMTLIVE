<?php


namespace App\Helpers;
use Request;
use App\LogActivity as LogActivityModel;


class LogActivity
{


    public static function addToLog($subject)
    {
    	$log = [];
    	$log['subject'] = $subject;
    	$log['url'] = Request::url();
    	$log['method'] = Request::method();
        $log['ip'] = Request::ip();
        $log['pcname'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
        $log['user_name'] = auth()->check() ? auth()->user()->fname : 1;
        $log['location'] = auth()->check() ? auth()->user()->location : 1;
    	LogActivityModel::create($log);
    }


}