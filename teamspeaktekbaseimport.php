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
	
	switch($_GET["api"]){
		case "importfromtekbase":
				$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE serverip = ".$dbconnect->Escape($_POST["rootserverauswahl"])."");
				$row = $dbconnect->FetchAssoc();
				
				$teamspeak = $dbconnect->RunQuery("SELECT * FROM teklab_teamspeak WHERE serverip = ".$dbconnect->Escape($_POST["rootserverauswahl"])."");
				$teamspeakrow = $dbconnect->FetchAssoc();
				
				$random = new Random();
				$password = $random->generateRandomUsername();
		
				$ssh = new ssh($row["serverip"], $row["sshport"]);
				$ssh->setDebugMode(false);
				
				if($dbconnect->NumRows($dbconnect->RunQuery("SELECT id FROM teamspeak_nodes WHERE rootserverauswahl = ".$dbconnect->Escape($_POST["rootserverauswahl"])."")) > 0){
					$false = "Dein Grundserver wurde schon importiert, bitte wähle einen anderen Grundserver aus.";
				}else{
					if($ssh){
						if($ssh->login($row["sshuser"], $row["daemonpasswd"])){
							if($ssh->DaemonExists()){
								if($dbconnect->NumRows($dbconnect->RunQuery("SELECT slots, serverport, serverip, memberid FROM teklab_voiceserver WHERE serverip = ".$dbconnect->Escape($_POST["rootserverauswahl"])."")) > 0){
									$row = $dbconnect->FetchAssoc();
									$dbconnect->RunQuery("INSERT INTO teamspeak_nodes (teamspeakip, teamspeakusername, teamspeakpassword, rootserverauswahl, nodeimported, nodepfad, query_ip_whitelist_angepasst, teamspeaknodedebuggingerror, queryport, voiceport) VALUES (".$dbconnect->Escape($row["serverip"]).", 'serveradmin', '$password', ".$dbconnect->Escape($_POST["rootserverauswahl"]).", '1', ".$dbconnect->Escape($teamspeakrow["path"]).", '0', '0', ".$dbconnect->Escape($teamspeakrow["queryport"]).", '9987')");
								
									$countvserver = $dbconnect->RunQuery("SELECT COUNT(id) FROM teklab_voiceserver WHERE serverip = ".$dbconnect->Escape($_POST["rootserverauswahl"])."")->fetchColumn();
								
									$virtualserverquery = $dbconnect->RunQuery("SELECT serverip, serverport, slots FROM teklab_voiceserver");
									while($virtualserver = $dbconnect->FetchAssoc())
									{
										$virtualserverow[] = $virtualserver;
									}
								
									$importedvserver = array();
									foreach($virtualserverow as $importedvserver)
									{
										$dbconnect->RunQuery("INSERT INTO teamspeak_virtualserver (name, teamspeakip, teamspeakport, slots, rootserverauswahl, kunden, gesperrt, imported) VALUES(".$dbconnect->Escape("tekbaseimportedvserver".rand(0,50).rand(0,100).rand(0,300)).", ".$dbconnect->Escape($importedvserver["serverip"]).",".$dbconnect->Escape($importedvserver["serverport"]).",".$dbconnect->Escape($importedvserver["slots"]).", ".$dbconnect->Escape($_POST["rootserverauswahl"]).", '', '0', '1')");
									}
									
									$nodepfad = $dbconnect->HtmlEscape($teamspeakrow["path"]);
									$ssh->execute("cd /home/skripte && sudo -u user-webi ./daemon stop 1 $nodepfad"); 
									$true = "Deine Grundserver/V-Server(".$dbconnect->HtmlEscape($countvserver).") sind erfolgreich importiert worden.";
								}else{
									$dbconnect->RunQuery("INSERT INTO teamspeak_nodes (teamspeakip, teamspeakusername, teamspeakpassword, rootserverauswahl, nodeimported, nodepfad, query_ip_whitelist_angepasst, teamspeaknodedebuggingerror, queryport, voiceport) VALUES (".$dbconnect->Escape($row["serverip"]).", 'serveradmin', '$password', ".$dbconnect->Escape($_POST["rootserverauswahl"]).", '1', ".$dbconnect->Escape($teamspeakrow["path"]).", '0', '0', ".$dbconnect->Escape($teamspeakrow["queryport"]).", '9987')");
									$true = "Deine Grundserver/V-Server(0) sind erfolgreich importiert worden.";
								}
							}else{
								$false = "Bitte installieren sie denn Daemon.";
							}
						}else{
							$false = "SSH-Username oder SSH-Password ist falsch.";
						}
					}else{
						$false = "Konnte keine Verbindung zum Host: ".$dbconnect->HtmlEscape($teamspeakrow["serverip"])." und Port: ".$dbconnect->HtmlEscape($teamspeakrow["sshport"])." herstellen.";
					}
				}
		break;	
	}
	
	include ("templates/teamspeaknode/teamspeaktekbaseimport.php");
    include ("admin/footer.php");
}

switch ($op) {
	
	case "adminteamspeaktekbaseimport":
	admintest($ids, $test, $save);
	break;

}
}else{
adminLogin($admin);
}
?>