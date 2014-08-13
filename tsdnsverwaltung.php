<?php
if (preg_match("/tsdns.php/i", $_SERVER['PHP_SELF'])) { 
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
		if($dbconnect->NumRows($dbconnect->RunQuery("SELECT id, teamspeakip, teamspeakusername, teamspeakpassword, rootserverauswahl, nodeimported, nodepfad FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["edit"])."")) > 0){
			global $row;
			global $ex;
			global $serverstatus;
			global $rootserverauswahl;
			$row = $dbconnect->FetchAssoc();
							
			try {
				$ts3_ServerInstance = TeamSpeak3::factory("serverquery://serveradmin:".$dbconnect->HtmlEscape($row["teamspeakpassword"])."@".$dbconnect->HtmlEscape($row["teamspeakip"]).":10011/?server_port=9987");
				$ts3serverinstance = $ts3_ServerInstance->serverGetByPort($ts3_ServerInstance["virtualserver_port"]);
				
			}catch(Exception $ex){
				$false = $ex->getMessage();
			}		
			
		}else{
			die("Teamspeakserver existiert nicht mehr");
		}
			
		include ("templates/teamspeaknode/tsdnsverwaltung.php");
	}
	
	if(isset($_GET["tsdnsid"])){
		if($dbconnect->NumRows($dbconnect->RunQuery("SELECT id, teamspeakip, teamspeakusername, teamspeakpassword, rootserverauswahl, nodeimported, nodepfad FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["nodehost"])."")) > 0){
			global $row;
			global $ex;
			global $serverstatus;
			global $rootserverauswahl;
			$row = $dbconnect->FetchAssoc();
	
			$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE name = ".$dbconnect->Escape($row["rootserverauswahl"])."");
			$teamspeakrow = $dbconnect->FetchAssoc();
			
			$ssh = new SSH($teamspeakrow["serverip"], $teamspeakrow["sshport"]);		
			$ssh->setDebugMode(false);	
						
			if($ssh){
				if($ssh->login($teamspeakrow["sshuser"], $teamspeakrow["daemonpasswd"])){
					$nodeimported = $dbconnect->HtmlEscape($row["nodeimported"]);
					$nodepfad = $dbconnect->HtmlEscape($row["nodepfad"]);
					
					$dbconnect->RunQuery("SELECT tsdnseintrag FROM teamspeak_nodes_tsdns WHERE id = ".$dbconnect->Escape($_GET["tsdnsid"])."");
					$tsdnsrow = $dbconnect->FetchAssoc();
					$tsdnseintrag = $dbconnect->HtmlEscape($tsdnsrow["tsdnseintrag"]);
					
					$bitarch = $ssh->execute("uname -m");
					$bitdata = $ssh->data;
						
					if(strpos($bitdata, "i686") !== false){
						$bitsystemordner = "teamspeak3-server_linux-x86";
					}else{
						$bitsystemordner = "teamspeak3-server_linux-amd64";
					}
					
					if($ssh->DaemonExists()){
                       if(ssh->execute("cd /home/skripte && sudo -u ".$dbconnect->HtmlEscape($row["sshuser"])." ./daemon tsdnstop")){
                          $true = "true";
                       }else{
                          $false = "false";
                       }

                       if($ssh->execute("cd /home/skripte && sudo -u ".$dbconnect->HtmlEscape($teamspeakrow["sshuser"])." ./daemon removeintrag $nodeimported $nodepfad $tsdnseintrag")){
						    $dbconnect->RunQuery("DELETE FROM teamspeak_nodes_tsdns WHERE id = ".$dbconnect->HtmlEscape($_GET["tsdnsid"])."");
							$true = "Der TSDNS-Eintrag wurde deletet.";
						    echo"<meta http-equiv=\"refresh\" content=\"0; url=admin.php?op=adminteamspeaktsdnsverwaltung&edit=".$dbconnect->HtmlEscape($_GET["nodehost"])."\">";
					   }else{
						  $false = "Der TSDNS-Eintrag konnte nicht deleted werden.";
					   }
                    }else{
                       $false = "Der TSDNS-Server konnte nicht gestoppt werden.";
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
	}else{
		$false = "Teamspeakserver existiert nicht mehr";
	}
  }

  include ("templates/teamspeaknode/tsdnsverwaltung.php");
}


switch ($op) {
	
	case "adminteamspeaktsdnsverwaltung":
	admintest($ids, $test, $save);
	break;

}
}else{
adminLogin($admin);
}

?>