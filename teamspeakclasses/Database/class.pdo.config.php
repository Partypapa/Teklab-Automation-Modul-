<?php
require_once("class.pdo.php");

global $dbconnect;

$dbconfig = array(
	"hostname" => $db->server,
	"username" => $db->user,
	"password" => $db->password,
	"db" => $db->dbname
);


$dbconnect = new Database($dbconfig["hostname"], $dbconfig["username"], $dbconfig["password"], $dbconfig["db"]);
$dbconnect->connectDB(); 
?>