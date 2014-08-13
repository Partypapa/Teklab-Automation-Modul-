<?php
ini_set('display_errors', 0);
error_reporting(0);

if (preg_match("/teamspeak.php/i", $_SERVER['PHP_SELF'])) { 
    Header("Location: ../index.php");
	die();
}

if(is_admin($admin)) {
function admintest($ids, $test, $save) {
    global $prefix, $admin, $db, $dbconnect;

	$ids = filter($ids, "", 1);
	$test = filter($test, "", 1);

	include("admin/header.php");
	include("teamspeakclasses/Database/class.pdo.config.php");
	include("teamspeakclasses/SSH/class.ssh.php");
	include("teamspeakclasses/libraries/TeamSpeak3/TeamSpeak3.php");

	$adminmsg = admin_title("cmodules", ""._TEAMSPEAK."", ""._ASSISTENTAPPLIST."", $iconset, "");
	echo ''.$adminmsg.'';	
	
	if(isset($_GET["edit"])){
		if($dbconnect->NumRows($dbconnect->RunQuery("SELECT id, teamspeakip, teamspeakusername, teamspeakpassword, rootserverauswahl FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["edit"])."")) > 0){
			global $row;
			global $ex;
			global $serverstatus;
			global $rootserverauswahl;
			$row = $dbconnect->FetchAssoc();

				try {
					$ts3_Serverinstance = TeamSpeak3::factory("serverquery://serveradmin:".$dbconnect->HtmlEscape($row["teamspeakpassword"])."@".$dbconnect->HtmlEscape($row["teamspeakip"]).":10011/?server_port=9987");
					$ts3serverinstance = $ts3_Serverinstance->serverGetByPort($ts3_Serverinstance["virtualserver_port"]);
				
				}catch(Exception $ex){
					$false = $ex->getMessage();
				}
		}else{
			die("Teamspeakserver existiert nicht mehr");
		}
	}
	
	include ("templates/teamspeakvirtualserver/teamspeakvirtualserveredit.php");
}

switch ($op) {
	
	case "adminteamspeakvirtualserveredit":
	admintest($ids, $test, $save);
	break;

}
}else{
adminLogin($admin);
}

?>