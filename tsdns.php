<?php
if (preg_match("/tsdns.php/i", $_SERVER['PHP_SELF'])) { 
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
	include("teamspeakclasses/SSH/Net/SSH2.php");
	include("teamspeakclasses/libraries/TeamSpeak3/TeamSpeak3.php");
	
	$adminmsg = admin_title("cmodules", ""._TEAMSPEAK."", ""._ASSISTENTAPPLIST."", $iconset, "");
	echo ''.$adminmsg.'';
	
	if(isset($_GET["edit"])){
		if($dbconnect->NumRows($dbconnect->RunQuery("SELECT id, teamspeakip, teamspeakusername, teamspeakpassword, rootserverauswahl, nodeimported, nodepfad FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["edit"])."")) > 0){
			global $row;
			global $ex;
			global $serverstatus;
			global $rootserverauswahl;
			$row = $dbconnect->FetchAssoc();
			
			switch($_GET["api"]){
				case "save":
					if(isset($_POST["submit"])){
						if(empty($_POST["ip"]) || empty($_POST["subdomain"]) || empty($_POST["port"])){
							$false = "Bitte fülle alle Felder mit einem (*) aus.";
						}else{
							$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE name = ".$dbconnect->Escape($row["rootserverauswahl"])."");
							$teamspeakrow = $dbconnect->FetchAssoc();
							
							$ssh = new ssh($teamspeakrow["serverip"], $teamspeakrow["sshport"]);
							$ssh->setDebugMode(true);
							
							if($ssh){
								if($ssh->login($teamspeakrow["sshuser"], $teamspeakrow["daemonpasswd"])){
									if($ssh->DaemonExists()){
										$nodeimported = $dbconnect->HtmlEscape($row["nodeimported"]);
										$teamspeakordner = $dbconnect->HtmlEscape($row["nodepfad"]);
										
										$subdomain = $dbconnect->HtmlEscape($_POST["subdomain"]);
										$ip = $dbconnect->HtmlEscape($_POST["ip"]);
										$port = $dbconnect->HtmlEscape($_POST["port"]);
										$tsdnseintrag = "$subdomain=$ip:$port";
										
										if($ssh->execute("cd /home/skripte && sudo -u ".$dbconnect->HtmlEscape($teamspeakrow["sshuser"])." ./daemon tsdnseintrag $nodeimported $teamspeakordner $subdomain $ip $port")){
											if($ssh->execute("cd /home/skripte && sudo -u user-webi ./daemon tsdnssrestart $nodeimported $teamspeakordner")){
												$dbconnect->RunQuery("INSERT INTO teamspeak_nodes_tsdns (tsdnseintrag, rootserverauswahl) VALUES('$tsdnseintrag', ".$dbconnect->Escape($row["rootserverauswahl"]).")");
												$true = "Der TSDNS Server wurde automatisch nach dem Eintrag restartet.";
												echo"<meta http-equiv=\"refresh\" content=\"0; url=admin.php?op=adminteamspeaktsdnsverwaltung&edit=".$dbconnect->HtmlEscape($_GET["nodehost"])."\">";
											}else{
												$false = "Der TSDNS Server konnte nicht restartet werden.";
											}
										}else{
											$false = "Die TSDNS-Einträge konnte nicht geschrieben werden.";
										}
									}else{
										$false = "Bitte installiere denn Daemon, damit du ein Node installieren kannst.";
									}
								}else{
									$false = "SSH-Username oder SSH-Password ist falsch.";
								}
							}else{
								$false = "Konnte keine Verbindung zum Host: ".$dbconnect->HtmlEscape($teamspeakrow["serverip"])." und Port: ".$dbconnect->HtmlEscape($teamspeakrow["sshport"])." herstellen.";
							}
						}
					}
				break;
			}
		}else{
			die("Teamspeakserver existiert nicht mehr");
		}
	}
	include ("templates/teamspeaknode/tsdns.php");
}

switch ($op) {
	
	case "adminteamspeaktsdns":
	admintest($ids, $test, $save);
	break;

}
}else{
adminLogin($admin);
}

?>