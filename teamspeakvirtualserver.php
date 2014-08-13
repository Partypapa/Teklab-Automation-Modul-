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
	global $ts3serverinstance;

	$ids = filter($ids, "", 1);
	$test = filter($test, "", 1);

	include("admin/header.php");
	include("teamspeakclasses/Database/class.pdo.config.php");
	include("teamspeakclasses/SSH/class.ssh.php");
	include("teamspeakclasses/SSH/Net/SSH2.php");
	include("teamspeakclasses/libraries/TeamSpeak3/TeamSpeak3.php");
	
	$adminmsg = admin_title("cmodules", ""._TEAMSPEAK."", ""._ASSISTENTAPPLIST."", $iconset, "");
	echo ''.$adminmsg.'';
	
	if(isset($_GET["edit"])){
		if($dbconnect->NumRows($dbconnect->RunQuery("SELECT id, teamspeakip, teamspeakusername, teamspeakpassword, rootserverauswahl FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["edit"])."")) > 0){
			global $row;
			global $ex;
			global $serverstatus;
			$row = $dbconnect->FetchAssoc();
			
			try {
				$ts3_ServerInstance = TeamSpeak3::factory("serverquery://serveradmin:".$dbconnect->HtmlEscape($row["teamspeakpassword"])."@".$dbconnect->HtmlEscape($row["teamspeakip"]).":10011/?server_port=9987");
				$ts3serverinstance = $ts3_ServerInstance->serverGetByPort($ts3_ServerInstance["virtualserver_port"]);	
					
			}catch(Exception $ex){
				$false = $ex->getMessage();
			}	
			
			switch($_GET["api"]){
				case "save":
					if(isset($_POST["submit"])){
						if(empty($_POST["name"]) || empty($_POST["port"]) || empty($_POST["slots"])){
							$false = "Bitte tippen sie alle Felder mit einem (*) ein.";
						}else{
							try {
								$ts3_ServerInstance->serverCreate(array("virtualserver_name" => $_POST["name"], "virtualserver_port" => $_POST["port"], "virtualserver_maxclients" => $_POST["slot"], "virtualserver_hostbutton_tooltip" => $_POST["hostbuttontooltip"], "virtualserver_hostbutton_url" => $_POST["hostbuttontooltipurl"], "virtualserver_hostbutton_gfx_url" =>  $_POST["hostbuttongfxurl"]));						
								$dbconnect->RunQuery("INSERT INTO teamspeak_virtualserver (name, teamspeakip, teamspeakport, slots, rootserverauswahl, kunden, gesperrt) VALUES (".$dbconnect->Escape($_POST["name"]).",".$dbconnect->Escape($row["teamspeakip"]).", ".$dbconnect->Escape($_POST["port"]).", ".$dbconnect->Escape($_POST["slots"]).", ".$dbconnect->Escape($row["rootserverauswahl"]).", ".$dbconnect->Escape($_POST["kundenauswahl"]).", '0')");
								$true = "Dein Teamspeakvirtualserver (".$dbconnect->HtmlEscape($_POST["name"]).") wurde aufgesetzt.";
								
							}catch(Exception $ex){
								$false = $ex->getMessage();
							}
						}
					}
				break;
			}
		}else{
			die("Teamspeakserver existiert nicht mehr");
		}
	}
	
	include ("templates/teamspeakvirtualserver/teamspeakvirtualserver.php");
}

switch ($op) {
	
	case "adminteamspeakvirtualserver":
	admintest($ids, $test, $save);
	break;

}
}else{
adminLogin($admin);
}

?>