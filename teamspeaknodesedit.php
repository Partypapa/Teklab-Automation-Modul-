<?php
session_start();

if(is_admin($admin)) {
function admintest($ids, $test, $save) {
    global $prefix, $admin, $db;
	global $dbconnect;
	global $dbserver;
	global $false;
	global $true;
	global $version;
	global $ts3serverinstance;
	global $consoleoutput;

	$ids = filter($ids, "", 1);
	$test = filter($test, "", 1);

	include("admin/header.php");
	include("teamspeakclasses/Database/class.pdo.config.php");
	include("teamspeakclasses/SSH/class.ssh.php");
	include("teamspeakclasses/libraries/TeamSpeak3/TeamSpeak3.php");
	include("teamspeakclasses/Random/class.random.php");
	include("teamspeakclasses/TSViewer/class.ts3viewer.php");
						
	$adminmsg = admin_title("cmodules", ""._TEAMSPEAK."", ""._ASSISTENTAPPLIST."", $iconset, "");
	echo ''.$adminmsg.'';

	if(isset($_GET["edit"])){
		if($dbconnect->NumRows($dbconnect->RunQuery("SELECT id, teamspeakip, teamspeakusername, teamspeakpassword, rootserverauswahl, nodeimported, nodepfad, query_ip_whitelist_angepasst, teamspeaknodedebuggingerror, queryport, voiceport FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["edit"])."")) > 0){
			global $row;
			global $ex;
			$row = $dbconnect->FetchAssoc();
			
			try {
				$ts3_ServerInstance = TeamSpeak3::factory("serverquery://serveradmin:".$dbconnect->HtmlEscape($row["teamspeakpassword"])."@".$dbconnect->HtmlEscape($row["teamspeakip"]).":".$dbconnect->HtmlEscape($row["queryport"])."/?server_port=".$dbconnect->HtmlEscape($row["voiceport"])."&blocking=0");
				$ts3serverinstance = $ts3_ServerInstance->serverGetByPort($ts3_ServerInstance["virtualserver_port"]);
				$version = "Dein Server läuft auf der Version ".$dbconnect->HtmlEscape($ts3_ServerInstance["virtualserver_version"])."";
				
			}catch(Exception $ex){
				if($row["teamspeaknodedebuggingerror"] == 0){
					/* kein debugging */
				}else{
					$false = $ex->getMessage();
				}
			}
		
			$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE name = ".$dbconnect->Escape($row["rootserverauswahl"])."");
			$teamspeakrow = $dbconnect->FetchAssoc();
			
			$ssh = new SSH($teamspeakrow["serverip"], $teamspeakrow["sshport"]);		
			$ssh->setDebugMode(false);	
				
			if(isset($_POST["submit"])){
				if(empty($_POST["webserverip"])){
					echo"<script>alert(\"Bitte tippe sie eine Query-IP ein.\")</script>";
				}else{
					if($ssh){
						if($ssh->login($teamspeakrow["sshuser"], $teamspeakrow["daemonpasswd"])){
							if($row["query_ip_whitelist_angepasst"] == 0){
								if($ssh->DaemonExists()){
									$nodeimported = $dbconnect->HtmlEscape($row["nodeimported"]);
									$ordner = $dbconnect->HtmlEscape($row["nodepfad"]);
									$tsip = $dbconnect->HtmlEscape($_POST["webserverip"]);
								
									if($ssh->execute("cd /home/skripte && sudo -u ".$dbconnect->HtmlEscape($teamspeakrow["sshuser"])." ./daemon createipwhitelistfile $nodeimported $ordner $tsip")){
										$nodeimported = $dbconnect->HtmlEscape($row["nodeimported"]);
										$teamspeakpassword = $dbconnect->HtmlEscape($row["teamspeakpassword"]);
										$ordner = $dbconnect->HtmlEscape($row["nodepfad"]);
									
										if($ssh->execute("cd /home/skripte && sudo -u ".$dbconnect->HtmlEscape($teamspeakrow["sshuser"])." ./daemon restart $nodeimported $ordner $teamspeakpassword")){
											$true = "Der Teamspeakserver wurde automatisch restartet - Query-IP-Whitelist-File Auto Updatet.";
											$dbconnect->RunQuery("UPDATE teamspeak_nodes SET query_ip_whitelist_angepasst = '1' WHERE id = ".$dbconnect->Escape($_GET["edit"])."");
											echo"<meta http-equiv=\"refresh\" content=\"5; url=admin.php?op=adminteamspeaknodesedit&edit=".$dbconnect->HtmlEscape($_GET["edit"])."\">";
										}else{
											$false = "Der Teamspeakserver konnte nicht restartet werden.";
										}
									}else{
										$false = "Das Whitelist File konnte nicht geupdatet werden.";
									}
								}else{
									$false = "Bitte installiere denn Daemon, damit du ein Node verwalten kannst.";
								}
							}
						}
					}
				}
			}
			
			switch($_GET["api"]){
				case "start":
					$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE name = ".$dbconnect->Escape($row["rootserverauswahl"])."");
					$teamspeakrow = $dbconnect->FetchAssoc();

					$ssh = new SSH($teamspeakrow["serverip"], $teamspeakrow["sshport"]);		
					$ssh->setDebugMode(false);	
						
					if($ssh){
						if($ssh->login($teamspeakrow["sshuser"], $teamspeakrow["daemonpasswd"])){
							if($ssh->DaemonExists()){
								$nodeimported = $dbconnect->HtmlEscape($row["nodeimported"]);
								$teamspeakpassword = $dbconnect->HtmlEscape($row["teamspeakpassword"]);
								$ordner = $dbconnect->HtmlEscape($row["nodepfad"]);
								
								if($ssh->execute("cd /home/skripte && sudo -u ".$dbconnect->HtmlEscape($teamspeakrow["sshuser"])." ./daemon start $nodeimported $ordner $teamspeakpassword")){
									echo"<meta http-equiv=\"refresh\" content=\"0; url=admin.php?op=adminteamspeaknodesedit&edit=".$dbconnect->HtmlEscape($_GET["edit"])."\">";
									$true = "Der Teamspeakserver wurde gestartet.";
								}else{
									$false = "Der Teamspeakserver konnte nicht gestartet werden.";
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
					
					break;
					
				case "stop":
					$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE name = ".$dbconnect->Escape($row["rootserverauswahl"])."");
					$teamspeakrow = $dbconnect->FetchAssoc();

					$ssh = new SSH($teamspeakrow["serverip"], $teamspeakrow["sshport"]);		
					$ssh->setDebugMode(false);	
						
					if($ssh){
						if($ssh->login($teamspeakrow["sshuser"], $teamspeakrow["daemonpasswd"])){
							if($ssh->DaemonExists()){
								$nodeimported = $dbconnect->HtmlEscape($row["nodeimported"]);
								$teamspeakpassword = $dbconnect->HtmlEscape($row["teamspeakpassword"]);
								$ordner = $dbconnect->HtmlEscape($row["nodepfad"]);
								
								if($ssh->execute("cd /home/skripte && sudo -u ".$dbconnect->HtmlEscape($teamspeakrow["sshuser"])." ./daemon stop")){
									echo"<meta http-equiv=\"refresh\" content=\"0; url=admin.php?op=adminteamspeaknodesedit&edit=".$dbconnect->HtmlEscape($_GET["edit"])."\">";
									$true = "Der Teamspeakserver wurde gestoppt.";
								}else{
									$false = "Der Teamspeakserver konnte nicht gestoppt werden.";
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
					break;
					
					case "restart":
						$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE name = ".$dbconnect->Escape($row["rootserverauswahl"])."");
						$teamspeakrow = $dbconnect->FetchAssoc();

						$ssh = new SSH($teamspeakrow["serverip"], $teamspeakrow["sshport"]);		
						$ssh->setDebugMode(false);	
							
						if($ssh){
							if($ssh->login($teamspeakrow["sshuser"], $teamspeakrow["daemonpasswd"])){
								if($ssh->DaemonExists()){
									$nodeimported = $dbconnect->HtmlEscape($row["nodeimported"]);
									$teamspeakpassword = $dbconnect->HtmlEscape($row["teamspeakpassword"]);
									$ordner = $dbconnect->HtmlEscape($row["nodepfad"]);
								
									if($ssh->execute("cd /home/skripte && sudo -u ".$dbconnect->HtmlEscape($teamspeakrow["sshuser"])." ./daemon restart $nodeimported $ordner $teamspeakpassword")){
										$true = "Der Teamspeakserver wurde restartet.";
									}else{
										$false = "Der Teamspeakserver konnte nicht restartet werden.";
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
					break;
					
					case "channelrechtebackupcreate":
						$dbconnect->RunQuery("SELECT id, teamspeakip, teamspeakpassword, rootserverauswahl, query_ip_whitelist_angepasst FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["edit"])."");
						$row = $dbconnect->FetchAssoc();
						
						if($ts3serverinstance["virtualserver_status"] == "online"){
							chmod("admin/ownmodules/channelsrechtebackups", 0777);
							if(mkdir("admin/ownmodules/channelsrechtebackups")){
								if(file_exists("admin/ownmodules/channelsrechtebackups")){
									$true = "Das Verzeichnis und die Dateien wurden erstellt.";
								}else{
									$false = "Das File oder der Ordner existiert nicht, sind die Rechte gesetzt?";
								}
							}else{
								$teamspeakip = $dbconnect->HtmlEscape($row["teamspeakip"]);
								$teamspeaktimestamp = $dbconnect->HtmlEscape(date("D.M.Y:H:i:s"));
							
								$file = fopen("admin/ownmodules/channelsrechtebackups/$teamspeakip.$teamspeaktimestamp.txt", "a+");
								$snapshot = $ts3serverinstance->snapshotCreate();
								fwrite($file, $snapshot);
								$dbconnect->RunQuery("INSERT INTO teamspeak_nodes_backups (backupfile, backupdate, rootserverauswahl) VALUES (".$dbconnect->Escape("$teamspeakip.$teamspeaktimestamp.txt").", ".$dbconnect->Escape(date("D.M.Y:H:i:s")).", ".$dbconnect->Escape($row["rootserverauswahl"]).")");
								$true = "Ein neues Channel-Rechte Backupfile wurde geschrieben du findest es in /admin/ownmodules/channelsrechtebackup.";
							}
						}else{
							$false = "Dein Teamspeakserver muss Online sein, damit du diese Aktionen ausführen kannst.";
						}
						break;
					
					case "save":
						if(isset($_POST["submit"])){
							if(empty($_POST["name"])){
								$false = "Bitte fülle alle Felder mit einem (*) aus.";
							}else{	
								$dbconnect->RunQuery("SELECT id, teamspeakip, teamspeakusername, teamspeakpassword, query_ip_whitelist_angepasst FROM teamspeak_nodes WHERE id = ".$dbconnect->HtmlEscape($_GET["edit"])."");
								$row = $dbconnect->FetchAssoc();
						
								try {									
									if($ts3serverinstance["virtualserver_status"] == "online"){
										if(strlen($_POST["password"]) == null)
										{
											$password = "";
										}
										else
										{
											$password = $dbconnect->HtmlEscape($_POST["password"]);
										}
									
										$ts3serverinstance->modify(array("virtualserver_name" => $_POST["name"], "virtualserver_welcomemessage" => $_POST["welcomemessage"], "virtualserver_password" => $password, "virtualserver_hostbanner_url" => $_POST["hostbannerurl"], "virtualserver_hostbanner_gfx_url" => $_POST["hostbannergfxurl"], "virtualserver_hostbutton_tooltip" => $_POST["hostbuttontooltip"], "virtualserver_hostbutton_url" => $_POST["hostbuttonurl"], "virtualserver_hostbutton_gfx_url" => $_POST["hostbuttongfxurl"], "virtualserver_hostbanner_mode" => $_POST["hostbannermode"]));
										$true = "Die Konfiguration wurde gespeichert.";
									}else{
										$false = "Dein Teamspeakserver muss Online sein, damit du diese Aktionen ausführen kannst.";
									}
								
								}catch(Exception $ex){
									if($row["teamspeaknodedebuggingerror"] == 0){
										/* kein debugging */
									}else{
										$false = $ex->getMessage();
									}
								}
							}
						}
					break;
					
					case "tokencreate":
						try {
							if(isset($_GET["servergroupname"])){
								if($ts3serverinstance["virtualserver_status"] == "online"){
									$servergroup = $ts3serverinstance->serverGroupGetByName($_GET["servergroupname"]);
									$token = $servergroup->privilegeKeyCreate();
									$true = "Der neue Token wurde erstellt er lautet: ".$dbconnect->HtmlEscape($token)."";
								}else{
									$false = "Dein Teamspeakserver muss Online sein, damit du diese Aktionen ausführen kannst.";
								}
							}
							
						}catch(Exception $ex){
							if($row["teamspeaknodedebuggingerror"] == 0){
								/* kein debugging */
							}else{
								$false = $ex->getMessage();
							}
						}
					break;
					
					case "resetserverperm":
						try {
							$reset = $ts3serverinstance->request("permreset")->toList();
							$true = "Die Serverpermissions wurden zurückgesetzt dein neuer Token lautet: ".$dbconnect->HtmlEscape($reset["token"])."";
													
						}catch(Exception $ex){
							if($row["teamspeaknodedebuggingerror"] == 0){
								/* kein debugging */
							}else{
								$false = $ex->getMessage();
							}
						}
					break;
					
					case "tsdnsstart":
						$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE name = ".$dbconnect->Escape($row["rootserverauswahl"])."");
						$teamspeakrow = $dbconnect->FetchAssoc();
				
						$ssh = new SSH($teamspeakrow["serverip"], $teamspeakrow["sshport"]);		
						$ssh->setDebugMode(false);	
						
						if($ssh){
							if($ssh->login($teamspeakrow["sshuser"], $teamspeakrow["daemonpasswd"])){
								if($ssh->DaemonExists()){
									$teamspeakordner = $dbconnect->HtmlEscape($row["nodepfad"]);
									$nodeimported = $dbconnect->HtmlEscape($row["nodeimported"]);
									
									if($ssh->execute("cd /home/skripte && sudo -u ".$dbconnect->HtmlEscape($teamspeakrow["sshuser"])." ./daemon tsdnsstart $nodeimported $teamspeakordner")){
										$true = "TSDNS wurde gestartet.";
									}else{
										$false = "TSDNS konnte nicht gestartet werden.";
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
					break;
					
					case "tsdnsstop":
						$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE name = ".$dbconnect->Escape($row["rootserverauswahl"])."");
						$teamspeakrow = $dbconnect->FetchAssoc();

						$ssh = new SSH($teamspeakrow["serverip"], $teamspeakrow["sshport"]);		
						$ssh->setDebugMode(false);	
						
						if($ssh){
							if($ssh->login($teamspeakrow["sshuser"], $teamspeakrow["daemonpasswd"])){
								if($ssh->DaemonExists()){
									if($ssh->execute("cd /home/skripte &&  sudo -u ".$dbconnect->HtmlEscape($teamspeakrow["sshuser"])." ./daemon tsdnsstop")){
										$true = "Der TSDNS Server wurde gestoppt.";
									}else{
										$false = "Der TSDNS Server konnte nicht gestoppt werden.";
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
					break;
			
				case "tsdnsrestart":
					$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE name = ".$dbconnect->Escape($row["rootserverauswahl"])."");
					$teamspeakrow = $dbconnect->FetchAssoc();

					$ssh = new SSH($teamspeakrow["serverip"], $teamspeakrow["sshport"]);		
					$ssh->setDebugMode(false);	
						
					if($ssh){
							if($ssh->login($teamspeakrow["sshuser"], $teamspeakrow["daemonpasswd"])){
								if($ssh->DaemonExists()){
									if($ssh->execute("cd /home/skripte &&  sudo -u user-webi ./daemon tsdnssrestart $nodeimported")){
										$true = "Der TSDNS Server wurde restartet.";
									}else{
										$false = "Der TSDNS Server konnte nicht restartet werden.";
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
				break;	
			
			
				case "createts3serverini":
					if(isset($_POST["huso"])){
						if(empty($_POST["voiceserverip"]) || empty($_POST["voiceserverport"]) || empty($_POST["filetransfer_port"]) || empty($_POST["filetransfer_ip"]) || empty($_POST["query_port"]) || empty($_POST["query_ip"])){
							$false = "Bitte fühlen sie alle Felder mit einem (*) aus.";
						}else{
							$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE name = ".$dbconnect->Escape($row["rootserverauswahl"])."");
							$teamspeakrow = $dbconnect->FetchAssoc();
							
							$dbconnect->RunQuery("SELECT nodeimported, nodepfad, teamspeakpassword, query_ip_whitelist_angepasst FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["edit"])."");
							$row = $dbconnect->FetchAssoc();
							
							$ssh = new SSH($teamspeakrow["serverip"], $teamspeakrow["sshport"]);		
							$ssh->setDebugMode(false);	
						
							if($ssh){
								if($ssh->login($teamspeakrow["sshuser"], $teamspeakrow["daemonpasswd"])){
									if($ssh->DaemonExists()){
										$teamspeakordner = $dbconnect->HtmlEscape($row["nodepfad"]);
										$nodeimported = $dbconnect->HtmlEscape($row["nodeimported"]);
										$teamspeakpassword = $dbconnect->HtmlEscape($row["teamspeakpassword"]);
										
										$voiceip = $dbconnect->HtmlEscape($_POST["voiceserverip"]);
										$voiceport = $dbconnect->HtmlEscape($_POST["voiceserverport"]);
										$filetransferport = $dbconnect->HtmlEscape($_POST["filetransfer_port"]);
										$filetransferip = $dbconnect->HtmlEscape($_POST["filetransfer_ip"]);
										$queryip = $dbconnect->HtmlEscape($_POST["query_ip"]);
										$queryport = $dbconnect->HtmlEscape($_POST["query_port"]);
																				
										if($ssh->execute("cd /home/skripte &&  sudo -u ".$dbconnect->HtmlEscape($teamspeakrow["sshuser"])." ./daemon createts3serverini $nodeimported $teamspeakordner $filetransferport $filetransferip $queryport $queryip")){
											try {
												$ts3serverinstance->modify(array("virtualserver_port" => $voiceport));
												$dbconnect->RunQuery("UPDATE teamspeak_nodes SET voiceport = ".$dbconnect->Escape($voiceport).", queryport = ".$dbconnect->Escape($queryport)." WHERE id = ".$dbconnect->Escape($_GET["edit"])."");
												
												if($ssh->execute("cd /home/skripte && sudo -u ".$dbconnect->HtmlEscape($teamspeakrow["sshuser"])." ./daemon stop")){
													if($ssh->execute("cd /home/skripte && sudo -u user-webi ./daemon start $nodeimported $teamspeakordner $teamspeakpassword")){
														echo"<meta http-equiv=\"refresh\" content=\"0; url=admin.php?op=adminteamspeaknodesedit&edit=".$dbconnect->HtmlEscape($_GET["edit"])."\">";
														$true = "Die neuen Einstellungen wurden gespeichert.";
													}else{
														$false = "Fehler beim starten des Teamspeakserver.";
													}
												}else{
													$false = "Fehler beim stoppen des Teamspeakserver.";
												}	
												
											}catch(Exception $ex){
												if($row["teamspeaknodedebuggingerror"] == 0){
													/* kein debugging */
												}else{
													$false = $ex->getMessage();
												}
											}
										}else{
											$true = "TS3Server.ini konnte nicht neu angelegt werden.";
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

			
				case "sendservernachricht":
					if(isset($_POST["servertsubmit"])){
						if(empty($_POST["servernachricht"])){
							$false = "Bitte tippen sie eine Servernachricht ein.";
						}else{
							try {
								if($ts3serverinstance["virtualserver_status"] == "online"){
									$ts3serverinstance->message($_POST["servernachricht"]);
									$true = "Die Nachricht wurde verschickt.";
								}else{
									$false = "Dein Teamspeakserver muss Online sein, damit du diese Aktionen ausführen kannst.";
								}
								
							}catch(Exception $ex){
								if($row["teamspeaknodedebuggingerror"] == 0){
									/* kein debugging */
								}else{
									$false = $ex->getMessage();
								}
							}
						}
					}
				break;
			}
			
			include('templates/teamspeaknode/teamspeaknodesedit.php');
			include('admin/footer.php');
		}else{
			die("Teamspeakserver existiert nicht mehr.");
		}
	}
	
	if(isset($_GET["delete"])){
		if($dbconnect->NumRows($dbconnect->RunQuery("SELECT id FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["delete"])."")) > 0){			
			$query = $dbconnect->RunQuery("SELECT teamspeakpassword, teamspeakip, rootserverauswahl, nodeimported, nodepfad FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["delete"])."");
			$row = $dbconnect->FetchAssoc();
			
			$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE name = ".$dbconnect->Escape($row["rootserverauswahl"])."");
			$teamspeakrow = $dbconnect->FetchAssoc();
				
			$ssh = new SSH($teamspeakrow["serverip"], $teamspeakrow["sshport"]);
			$ssh->setDebugMode(false);
			
			if($ssh){
				if($ssh->login($teamspeakrow["sshuser"], $teamspeakrow["daemonpasswd"])){
					if($ssh->DaemonExists()){
						$ordner = $dbconnect->HtmlEscape($row["nodepfad"]);
						$nodeimported = $dbconnect->HtmlEscape($row["nodeimported"]);			
						
						$ssh->execute("ps aux | grep ts3server | grep -v grep | awk '{ print $2 }' | head -1");
						if($ssh->data != ""){
							$tsserver = "online";
						}else{
							$tsserver = "offline";
						}
			
						if($tsserver == "online"){
							$true = "Bitte stoppe denn Teamspeakserver zuerst bevor du ihn deletest.";
						}else{
							if($ssh->execute("cd /home/skripte && sudo -u ".$dbconnect->HtmlEscape($teamspeakrow["sshuser"])." ./daemon removeinstance $nodeimported $ordner")){
								$dbconnect->RunQuery("DELETE FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["delete"])."");
								echo"<meta http-equiv=\"refresh\" content=\"0; url=admin.php?op=adminteamspeaknodes\">";
								$true = "Dein Teamspeakserver wurde deleted.";
							}else{
								$false = "Der Teamspeakserver konnte nicht deleted werden.";
							}
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
		
	   include("templates/teamspeaknode/teamspeaknodesedit.php");
	}
}	

switch ($op) {
	case "adminteamspeaknodesedit":
	admintest($ids, $test, $save);
	break;

}
}else{
adminLogin($admin);
}
?>