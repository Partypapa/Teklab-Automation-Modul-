<?php
if (preg_match("/teamspeak.php/i", $_SERVER['PHP_SELF'])) { 
    Header("Location: ../index.php");
	die();
}

if(is_admin($admin)) {
function admintest($ids, $test, $save) {
    global $prefix, $admin, $db, $dbconnect;

	$ids = filter($ids, "", 1);
	$test = filter($test, "", 1);

    include ("admin/header.php");
	include ("teamspeakclasses/Database/class.pdo.config.php");
	include ("teamspeakclasses/SSH/class.ssh.php");
	include ("teamspeakclasses/Random/class.random.php");
	
	switch($_GET["api"]){
	case "installteamspeak":
		$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE name = ".$dbconnect->Escape($_POST["rootserverauswahl"])."");
		$row = $dbconnect->FetchAssoc();
		
		if(!empty($_POST["rootserverauswahl"])){
			if($dbconnect->NumRows($dbconnect->RunQuery("SELECT rootserverauswahl FROM teamspeak_nodes WHERE rootserverauswahl = ".$dbconnect->Escape($_POST["rootserverauswahl"])."")) > 0){
				$false = "Dieser Rootserver existiert bereits als Teamspeak-Node.";
			}else{
				$ssh = new ssh($row["serverip"], $row["sshport"]);
				$ssh->setDebugMode(false);
			
				if($ssh){		
					if($ssh->login($row["sshuser"], $row["daemonpasswd"])){
						$bitarch = $ssh->execute("uname -m");
						$bitdata = $ssh->data;
						
						if(strpos($bitdata, "i686") !== false){
							$bitsystemordner = "teamspeak3-server_linux-x86";
						}else{
							$bitsystemordner = "teamspeak3-server_linux-amd64";
						}
						
						$random = new Random();
						$encrypted = $random->generateQueryPassword();
						
						if($ssh->DaemonExists()){
							if($ssh->execute("cd /home/skripte && sudo -u user-webi ./daemon install")){
								$dbconnect->RunQuery("INSERT INTO teamspeak_nodes (teamspeakip, teamspeakusername, teamspeakpassword, rootserverauswahl, nodeimported, nodepfad, query_ip_whitelist_angepasst, teamspeaknodedebuggingerror, queryport, voiceport) VALUES (".$dbconnect->Escape($row["serverip"]).", 'serveradmin', '$encrypted', ".$dbconnect->Escape($_POST["rootserverauswahl"]).", '0', ".$dbconnect->Escape($bitsystemordner).", '0', '0', '10011', '9987')");
								$true = "Teamspeakserver wurde auf ihrem Rootserver installiert, sie können ihren Server nun verwalten.";
							}else{
								$false = "Der Installer konnte nicht gestartet werden.";
							}
						}else{
							$false = "Bitte installiere denn Daemon, damit du ein Node installieren kannst.";
						}
					}else{
						$false = "Username oder Password ist falsch.";
					}
				}
			}
		}else{
			$false = "Kein Rootserver wurde angegeben.";
		}
		break;
	}	
	
	$adminmsg = admin_title("cmodules", ""._TEAMSPEAK."", ""._ASSISTENTAPPLIST."", $iconset, "");
	echo ''.$adminmsg.'';
	
	include ("templates/teamspeaknode/teamspeakpackagesinstaller.php");
    include ("admin/footer.php");
}

switch ($op) {
	
	case "adminteamspeak":
	admintest($ids, $test, $save);
	break;

}
}else{
adminLogin($admin);
}

?>