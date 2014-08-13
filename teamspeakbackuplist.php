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
		if($dbconnect->NumRows($dbconnect->RunQuery("SELECT id, teamspeakip, teamspeakusername, teamspeakpassword, rootserverauswahl, queryport, voiceport FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["edit"])."")) > 0){
			global $row;
			global $ex;
			global $ts3_ServerInstance;
			
			$row = $dbconnect->FetchAssoc();
				try {
					$ts3_ServerInstance = TeamSpeak3::factory("serverquery://serveradmin:".$dbconnect->HtmlEscape($row["teamspeakpassword"])."@".$dbconnect->HtmlEscape($row["teamspeakip"]).":".$dbconnect->HtmlEscape($row["queryport"])."/?server_port=".$dbconnect->HtmlEscape($row["voiceport"])."");
					$ts3serverinstance = $ts3_ServerInstance->serverGetByPort($ts3_ServerInstance["virtualserver_port"]);
				
				}catch(Exception $ex){
					$false = $ex->getMessage();
				}
			
			switch($_GET["api"]){
				case "backuprestore":
					$dbconnect->RunQuery("SELECT backupfile FROM teamspeak_nodes_backups WHERE id = ".$dbconnect->Escape($_GET["backupid"])."");
					$backuprow = $dbconnect->FetchAssoc();
					
					try {
						$backupfile = file("admin/ownmodules/channelsrechtebackups/".$dbconnect->HtmlEscape($backuprow["backupfile"])."");
						$ts3_ServerInstance->snapshotDeploy($backupfile[0]);
						$true = "Backupfile wurde eingespielt.";
						
					}catch(Exception $ex){
						$false = $ex->getMessage();
					}
				break;
			 
				case "backupdelete":
					$dbconnect->RunQuery("SELECT backupfile FROM teamspeak_nodes_backups WHERE id = ".$dbconnect->Escape($_GET["backupid"])."");
					$backupdeleterow = $dbconnect->FetchAssoc();
					
					if(unlink("admin/ownmodules/channelsrechtebackups/".$backupdeleterow["backupfile"]."")){	
						$dbconnect->RunQuery("DELETE FROM teamspeak_nodes_backups WHERE id = ".$dbconnect->Escape($_GET["backupid"])."");
						$true = "Das Backupfile wurde gelöscht.";
					}else{
						$false = "Das Backupfile wurde bereits gelöscht.";
					}
				break;
			}
		}else{
			die("Teamspeakserver existiert nicht mehr");
		}
	}
	include ("templates/teamspeaknode/teamspeaknodesbackup.php");
}

switch ($op) {
	
	case "adminteamspeakbackuplist":
	admintest($ids, $test, $save);
	break;

}
}else{
adminLogin($admin);
}

?>