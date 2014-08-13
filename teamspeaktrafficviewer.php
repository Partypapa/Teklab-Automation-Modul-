<?php
ini_set('display_errors', 0);
error_reporting(0);

if(is_admin($admin)) {
function admintest($ids, $test, $save) {
    global $prefix, $admin, $db;
	global $dbconnect;
	global $dbserver;
	global $random;

	$ids = filter($ids, "", 1);
	$test = filter($test, "", 1);

	include("admin/header.php");
	include("teamspeakclasses/Database/class.pdo.config.php");
	include("teamspeakclasses/SSH/class.ssh.php");
	include("teamspeakclasses/libraries/TeamSpeak3/TeamSpeak3.php");
	include("teamspeakclasses/Random/class.random.php");
						
	$adminmsg = admin_title("cmodules", ""._TEAMSPEAK."", ""._ASSISTENTAPPLIST."", $iconset, "");
	echo ''.$adminmsg.'';

	if(isset($_GET["edit"])){
		if($dbconnect->NumRows($dbconnect->RunQuery("SELECT id, teamspeakip, teamspeakusername, teamspeakpassword, rootserverauswahl, nodeimported, nodepfad FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["edit"])."")) > 0){
			global $row;
			global $ex;
			$row = $dbconnect->FetchAssoc();
			$random = new Random();
			
			$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE name = ".$dbconnect->Escape($row["rootserverauswahl"])."");
			$teamspeakrow = $dbconnect->FetchAssoc();			
		}else{
			die("Dein Teamspeakserver existiert nicht mehr");
		}
		
		include("templates/teamspeaknode/teamspeaktrafficviewer.php");
	}
}	

switch ($op) {
	case "adminteamspeaktrafficviewer":
	admintest($ids, $test, $save);
	break;

}
}else{
adminLogin($admin);
}
?>