<?php
session_start();
if(is_admin($admin)) {
function admintest($ids, $test, $save) {
    global $prefix, $admin, $db;
	global $dbconnect;
	global $dbserver;
	global $onlinestatus;

	$ids = filter($ids, "", 1);
	$test = filter($test, "", 1);

	include ("teamspeakclasses/Database/class.pdo.config.php");
	include ("teamspeakclasses/libraries/TeamSpeak3/TeamSpeak3.php");
	include ("teamspeakclasses/SSH/class.ssh.php");
	include ("teamspeakclasses/RC4/class.rc4crypt.php");
	
	if(isset($_GET["edit"])){
		if($dbconnect->NumRows($dbconnect->RunQuery("SELECT id, teamspeakip, teamspeakusername, teamspeakpassword, rootserverauswahl, nodeimported, nodepfad FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["edit"])."")) > 0){
			global $row;
			global $ex;
			$row = $dbconnect->FetchAssoc();
	
			switch($_GET["api"]){
				case "updatettsdebuggingerroron":
					$dbconnect->RunQuery("UPDATE teamspeak_nodes SET teamspeaknodedebuggingerror = '1' WHERE id = ".$dbconnect->Escape($_GET["edit"])."");
					echo"<meta http-equiv=\"refresh\" content=\"0; url=admin.php?op=adminteamspeaknodes\">";
				break;
				
				case "updatettsdebuggingerroroff":
					$dbconnect->RunQuery("UPDATE teamspeak_nodes SET teamspeaknodedebuggingerror = '0' WHERE id = ".$dbconnect->Escape($_GET["edit"])."");
					echo"<meta http-equiv=\"refresh\" content=\"0; url=admin.php?op=adminteamspeaknodes\">";
				break;
			}
		}else{
			echo"Der Teamspeak-Node existiert nicht";
		}
	}
}

switch ($op) {
	
	case "passwordsaveupdatet":
	admintest($ids, $test, $save);
	break;

}
}else{
adminLogin($admin);
}
?>