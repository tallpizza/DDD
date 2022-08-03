<?php
// $services['test'] = '_test';
// function _test() {
// 	error_log(__FILE__.":".__FUNCTION__);
	
// 	responseJSON("Services: Test", "success");
// 	};

$services['create'] = '_create';
function _create() {
	$id = $_POST["id"];
	$lat = $_POST["lat"];
    $lng = $_POST["lng"];
	
	error_log("test");

	if (!file_exists("GPS")) mkdir("GPS");
	$logf = 'GPS/' .$id."_".date('Ymd'). '.csv';
	$contents = date('Y/m/d H:i:s').",".$lat.",".$lng.",".$id. "\n";
	file_put_contents($logf,$contents,FILE_APPEND);
	
	responseJSON("Temperature:".$lat, "success");
}

// $services['read'] = '_read';
// function _read() {
// 	$id = $_POST["id"];
// 	// throw new Exception("hello"); error 시험문장
// 	error_log ("id : [".$id."]");
// 	$f="GPS/".$id."*.csv";
// 	$files= glob($f, GLOB_BRACE);
// 	error_log($f);
// 	$ret= "";
// 	error_log(print_r($files, True));
// 	//  print_r 은 텍스트만 출력되게
// 	foreach($files as $file) {
// 		$ret.= $file."\n"; 
// 	}
	
// 	responseJSON($ret, "success"); 
// }

// $services['list'] = '_list';
// function _list() {
// 	$id = $_POST["id"];

// 	$files= glob("GPS/".$id."*.csv", GLOB_BRACE);
// 	$ret= array(); 
// 	// read 랑 다른이유는, read 에선 텍스트형식만 출력 했는데 이번엔 리스트로 출력하기위해
// 	error_log(print_r($files, True));
// 	//  print_r 은 텍스트만 출력되게
// 	foreach($files as $file) {
// 		$ret[]= $file;
// 	}
	
// 	responseJSON($ret, "success"); 
// }

// $services['delete'] = '_delete';
// function _delete() {
// 	$file = $_POST["file"];
// 	if (!file_exists($file)) {
// 		responseJSON("[" + $file + "] 파일이없습니다");
// 	} else {
// 		unlink($file);
// 	}
// 	responseJSON($file,"sucess");
// }

// $services['upload'] = '_upload';
// function _upload() {
// 	if($_FILES['file']['error'] > 0) {
// 		responseJSON('An error occurred while uploading.');
// 	}

// 	error_log(print_r($_FILES,True));

// 	$file = $_FILES["file"]["name"];
// 	$file = str_replace(" ", "", $file);
// 	error_log("file name".$file);
// 	if (!file_exists("media")) mkdir("media");
// 	if (!move_uploaded_file($_FILES ['file']['tmp_name'],'media/'.$file)){
// 		responseJSON('Error uploading file :'.print_r($_FILES, true));
// 	}
// 	// success!
// 	responseJSON('Fileuploaded: ['.$file.']','success');
// };

?>