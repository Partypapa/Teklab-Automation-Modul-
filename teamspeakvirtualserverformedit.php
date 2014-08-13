<?php
ini_set('display_errors', 0);
error_reporting(0);

if(is_admin($admin)) {
function admintest($ids, $test, $save) {
    global $prefix, $admin, $db;
	global $dbconnect;
	global $dbserver;
	global $false;
	global $true;
	global $virtualserverinstance;

	$ids = filter($ids, "", 1);
	$test = filter($test, "", 1);

	include("admin/header.php");
	include("teamspeakclasses/Database/class.pdo.config.php");
	include("teamspeakclasses/SSH/class.ssh.php");
	include("teamspeakclasses/libraries/TeamSpeak3/TeamSpeak3.php");
						
	$adminmsg = admin_title("cmodules", ""._TEAMSPEAK."", ""._ASSISTENTAPPLIST."", $iconset, "");
	echo ''.$adminmsg.'';

	if(isset($_GET["virtualserverid"])){
		if($dbconnect->NumRows($dbconnect->RunQuery("SELECT name, teamspeakip, teamspeakport, slots, rootserverauswahl, kunden FROM teamspeak_virtualserver WHERE id = ".$dbconnect->Escape($_GET["virtualserverid"])."")) > 0){
			global $row;
			global $ex;
			
			$row = $dbconnect->FetchAssoc();
			$teamspeakquery = $dbconnect->RunQuery("SELECT teamspeakip, teamspeakpassword FROM teamspeak_nodes WHERE id = ".$dbconnect->HtmlEscape($_GET["nodehost"])."");
			$teamspeakrow = $dbconnect->FetchAssoc();
	
			try {
				$ts3_ServerInstance = TeamSpeak3::factory("serverquery://serveradmin:".$dbconnect->HtmlEscape($teamspeakrow["teamspeakpassword"])."@".$dbconnect->HtmlEscape($teamspeakrow["teamspeakip"]).":10011/?server_port=9987");
				$virtualserverinstance = $ts3_ServerInstance->serverGetByName($row["name"]);

			}catch(Exception $ex){
				$false = $ex->getMessage();
			}
			
			switch($_GET["api"]){
				case "stop":
					try {
						$ts3_ServerInstance = TeamSpeak3::factory("serverquery://serveradmin:".$dbconnect->HtmlEscape($teamspeakrow["teamspeakpassword"])."@".$dbconnect->HtmlEscape($teamspeakrow["teamspeakip"]).":10011/?server_port=9987");
						$virtualserverinstance = $ts3_ServerInstance->serverGetByName($row["name"]);
						$ts3_ServerInstance->serverStop($virtualserverinstance["virtualserver_id"]);
						$true = "Dein Virtualserver wurde gestoppt.";
					
					}catch(Exception $ex){
						$false = $ex->getMessage();
					}
				break;
				
				case "start":
					try {
						$ts3_ServerInstance = TeamSpeak3::factory("serverquery://serveradmin:".$dbconnect->HtmlEscape($teamspeakrow["teamspeakpassword"])."@".$dbconnect->HtmlEscape($teamspeakrow["teamspeakip"]).":10011/?server_port=9987");
						$virtualserverinstance = $ts3_ServerInstance->serverGetByName($row["name"]);
						$ts3_ServerInstance->serverStart($virtualserverinstance["virtualserver_id"]);
						$true = "Dein Virtualserver wurde gestartet.";
					
					}catch(Exception $ex){
						$false = $ex->getMessage();
					}
				break;
				
					case "backupcreate":
						if($virtualserverinstance["virtualserver_status"] == "online"){ 
							chmod("admin/ownmodules/virtualserverbackups", 0777);
							if(mkdir("admin/ownmodules/virtualserverbackups")){
								if(file_exists("admin/ownmodules/virtualserverbackups")){
									$true = "Das Verzeichnis und die Dateien wurden erstellt.";
								}else{
									$false = "Das File oder der Ordner existiert nicht, sind die Rechte gesetzt?";
								}
							}else{
								$teamspeakip = $dbconnect->HtmlEscape($row["teamspeakip"]);
								$teamspeaktimestamp = $dbconnect->HtmlEscape(date("D.M.Y:H:i:s"));
							
								$file = fopen("admin/ownmodules/virtualserverbackups/$teamspeakip.$teamspeaktimestamp.txt", "a+");
								$snapshot = $virtualserverinstance->snapshotCreate();
								fwrite($file, $snapshot);
								$dbconnect->RunQuery("INSERT INTO teamspeak_virtualserver_backups (backupfile, backupdate, rootserverauswahl) VALUES (".$dbconnect->Escape("$teamspeakip.$teamspeaktimestamp.txt").", ".$dbconnect->Escape(date("D.M.Y:H:i:s")).", ".$dbconnect->Escape($row["rootserverauswahl"]).")");
								$true = "Ein neues Backupfile wurde geschrieben du findest es in /admin/ownmodules/virtualserverbackups.";
							}
						}else{
							$false = "Du kannst nur ein Backup erstellen wenn dein Teamspeakserver Online ist.";
						}
						break;
					
				
				case "save":
						if(isset($_POST["submit"])){
							if(empty($_POST["name"])){
								$false = "Bitte fülle alle Felder mit einem (*) aus.";
							}else{	
						
								try {
									if(strlen($_POST["password"]) == null)
									{
										$password = "";
									}
									else
									{
										$password = $dbconnect->HtmlEscape($_POST["password"]);
									}
									
									$virtualserverinstance->modify(array("virtualserver_name" => $_POST["name"], "virtualserver_welcomemessage" => $_POST["welcomemessage"], "virtualserver_password" => $password, "virtualserver_hostbanner_url" => $_POST["hostbannerurl"], "virtualserver_hostbanner_gfx_url" => $_POST["hostbannergfxurl"], "virtualserver_hostbutton_tooltip" => $_POST["hostbuttontooltip"], "virtualserver_hostbutton_url" => $_POST["hostbuttonurl"], "virtualserver_hostbutton_gfx_url" => $_POST["hostbuttongfxurl"], "virtualserver_hostbanner_mode" => $_POST["hostbannermode"], "virtualserver_autostart" => $_POST["autostart"]));
									$dbconnect->RunQuery("UPDATE teamspeak_virtualserver SET name = ".$dbconnect->Escape($_POST["name"])." WHERE id = ".$dbconnect->Escape($_GET["virtualserverid"])."");
									$true = "Die Konfiguration wurde gespeichert.";
								
								}catch(Exception $ex){
									$false = $ex->getMessage();
								}
							}
						}
					break;
				
				case "tokencreate":
						try {
							$servergroup = $virtualserverinstance->serverGroupGetByName("Server Admin");
							$token = $servergroup->privilegeKeyCreate();
							
							$rootserver = $dbconnect->HtmlEscape($row["rootserverauswahl"]);
							$dbconnect->RunQuery("INSERT INTO teamspeak_virtualserver_tokens (token, teamspeakservergroup, rootserverauswahl) VALUES ('$token', 'Server Admin', '$rootserver')");
							$true = "Der neue Token wurde erstellt.";
							
						}catch(Exception $ex){
							$false = $ex->getMessage();
						}
					break;
					
					
					case "tokendelete":
						if(isset($_GET["delete"])){
							try {
								if($dbconnect->NumRows($dbconnect->RunQuery("DELETE FROM teamspeak_virtualserver_tokens WHERE token = ".$dbconnect->Escape($_GET["token"])."")) > 0){							
									$false = "Der Token wurde bereits schon gelöst und existiert nicht mehr.";
								}else{
									$token = $dbconnect->RunQuery("SELECT token FROM teamspeak_virtualserver_tokens WHERE id = ".$dbconnect->Escape($_GET["delete"])."");
									$tokenrow = $dbconnect->FetchAssoc();
									
									$token = $dbconnect->HtmlEscape($tokenrow["token"]);
									$virtualserverinstance->tokenDelete($token);
									$dbconnect->RunQuery("DELETE FROM teamspeak_virtualserver_tokens WHERE id = ".$dbconnect->Escape($_GET["delete"])."");
									$true = "Der Token wurde deleted.";
								}
								
							}catch(Exception $ex){
								$false = $ex->getMessage();
							}
						}
					break;
					
					
					case "delete":
						if($dbconnect->NumRows($dbconnect->RunQuery("SELECT id FROM teamspeak_virtualserver WHERE id = ".$dbconnect->Escape($_GET["virtualserverid"])."")) > 0){							
							try {
								$virtualserverinstance->serverStop($virtualserverinstance["virtualserver_id"]);
								$virtualserverinstance->serverDelete($virtualserverinstance["virtualserver_id"]);
								$dbconnect->RunQuery("DELETE * FROM teamspeak_virtualserver WHERE id = ".$dbconnect->Escape($_GET["virtualserverid"])."");
								
							}catch(Exception $ex){
								$false = $ex->getMessage();
							}
						}else{
							$false = "Der Teamspeakvirtualserver ist bereits deleted worden.";
						}
					break;
				
			}

			include('templates/teamspeakvirtualserverformedit.php');
			include('admin/footer.php');
		}else{
			die("Teamspeakserver existiert nicht mehr.");
		}
	}
}

switch ($op) {
	case "adminteamspeakvirtualservereditform":
	admintest($ids, $test, $save);
	break;

}
}else{
adminLogin($admin);
}
?>