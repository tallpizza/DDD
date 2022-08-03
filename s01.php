<?php
function responseJSON($msg, $status = 'error'){
    header('content-Type: application/json');
    //json포맷으로 형식을 쓸꺼다
	die(json_encode(array ( 
        // die 메세지를 보냈으면 죽어라
	    'data' => $msg,
		'status' => $status)));
}

include_once("s01_service.php");

$func = isset($_POST['func'])?$_POST['func']:"none";

if (!isset($services[$func]))
    responseJSON("no service[$func]");
    try {
        call_user_func($services[$func]);
    } 
    catch (Exception $e) {
        error_log(print_r($e->getTrace()));
        responseJSON($e->getMessage());
    }
?>