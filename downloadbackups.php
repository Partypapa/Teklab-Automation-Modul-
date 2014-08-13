<?php
$file_directory = "channelsrechtebackups"; 
$file = htmlspecialchars($_GET['file']); 
$file_array = explode('/', $file); 
$file_array_count = count($file_array);
$filename = $file_array[$file_array_count-1];
$file_path = dirname(__FILE__).'/'.$file_directory.'/'.$file; 

if(file_exists($file_path)) {
    header("Content-disposition: attachment; filename={$filename}");
    header('Content-type: application/octet-stream'); 
    readfile($file_path); 
}
else {
    echo "Sorry, the file does not exist!";
	var_dump($file_path);
}
?>