<?php
if(is_admin($admin)) {
function admintest($ids, $test, $save) {
    global $prefix, $admin, $db;
	global $dbconnect;
	global $dbserver;
	global $onlinestatus;

	$ids = filter($ids, "", 1);
	$test = filter($test, "", 1);

    include ("admin/header.php");
	include ("teamspeakclasses/Database/class.pdo.config.php");
	include ("teamspeakclasses/libraries/TeamSpeak3/TeamSpeak3.php");
	include ("teamspeakclasses/SSH/class.ssh.php");
	include ("teamspeakclasses/Random/class.random.php");
	
	$adminmsg = admin_title("cmodules", ""._TEAMSPEAK."", ""._ASSISTENTAPPLIST."", $iconset, "");
	echo ''.$adminmsg.'';
	
	include ("templates/teamspeaknode/teamspeaknodes.php");
    include ("admin/footer.php");
}

switch ($op) {
	
	case "adminteamspeaknodes":
	admintest($ids, $test, $save);
	break;

}
}else{
adminLogin($admin);
}
?>