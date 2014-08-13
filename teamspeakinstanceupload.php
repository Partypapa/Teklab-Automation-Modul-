<?php
session_start();
if (preg_match("/teamspeak.php/i", $_SERVER['PHP_SELF'])) { 
    Header("Location: ../index.php");
	die();
}

ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);

if(is_admin($admin)) {
function admintest($ids, $test, $save) {
    global $prefix, $admin, $db, $dbconnect;

	$ids = filter($ids, "", 1);
	$test = filter($test, "", 1);

    include ("admin/header.php");
	include ("teamspeakclasses/Database/class.pdo.config.php");
	include ("teamspeakclasses/SSH/class.ssh.php");
	include ("teamspeakclasses/Random/class.random.php");
	include ("teamspeakclasses/Random/class.rsa.php");
	
	switch($_GET["api"]){
	case "uploadinstance":
		$query = $dbconnect->RunQuery("SELECT name, serverip, sshuser, sshport, daemonpasswd FROM teklab_rootserver WHERE name = ".$dbconnect->Escape($_POST["rootserverauswahl"])."");
		$row = $dbconnect->FetchAssoc();
		
		if(!empty($_FILES["fileurl"])){
		  if($_FILES["fileurl"]["type"] == "application/x-gzip"){
				$ssh = new ssh($row["serverip"], $row["sshport"]);
				$ssh->setDebugMode(false);
			
				if($dbconnect->NumRows($dbconnect->RunQuery("SELECT rootserverauswahl FROM teamspeak_nodes WHERE rootserverauswahl = ".$dbconnect->Escape($_POST["rootserverauswahl"])."")) > 0){
					$false = "Dieser Rootserver existiert bereits als Teamspeak-Node.";
				}else{
					chmod("admin/ownmodules/uploadinstances", 0777);
					if(is_dir("admin/ownmodules/uploadinstances")){
						move_uploaded_file($_FILES["fileurl"]["tmp_name"], "admin/ownmodules/uploadinstances/".$dbconnect->HtmlEscape($_FILES["fileurl"]["name"]));
						
						if($ssh){
							if($ssh->login($row["sshuser"], $row["daemonpasswd"])){
								$random = new Random();
								$encrypted = $random->generateQueryPassword();
								
								$randomordnername = "".$dbconnect->HtmlEscape($_POST["rootserverauswahl"]).".".$dbconnect->HtmlEscape($encrypted)."";
								$filename = str_replace(".tar.gz", "", $dbconnect->HtmlEscape($_FILES["fileurl"]["name"]));
								
								if($ssh->UploadFile($_FILES["fileurl"]["name"])){				
									if($ssh->execute("cd /home/user-webi && tar xfv ".$dbconnect->HtmlEscape($_FILES["fileurl"]["name"])." && rm -r ".$dbconnect->HtmlEscape($_FILES["fileurl"]["name"])." && mv $filename $randomordnername")){
										$dbconnect->RunQuery("INSERT INTO teamspeak_nodes (teamspeakip, teamspeakusername, teamspeakpassword, rootserverauswahl, nodeimported, nodepfad, passwordshowed, query_ip_whitelist_angepasst, teamspeaknodedebuggingerror, queryport, voiceport) VALUES (".$dbconnect->Escape($row["serverip"]).", 'serveradmin', '$encrypted', ".$dbconnect->Escape($_POST["rootserverauswahl"]).", '1', ".$dbconnect->Escape($randomordnername).", '0', '0', '0', '10011', '9987')");
										unlink("admin/ownmodules/uploadinstances/".$dbconnect->HtmlEscape($_FILES["fileurl"]["name"])."");
										$true = "Dein Node wurde importiert, du kannst ihn nun verwalten.";
									}else{
										$false = "Dein Node konnte nicht importiert werden.";
									}	
								}else{
									$false = "Das File konnte nicht via SSH hochgeladen werden.";
								}
							}else{
								$false = "SSH-Username oder SSH-Password ist falsch.";
							}
						}else{
							$false = "Konnte keine Verbindung zum Host: ".$dbconnect->HtmlEscape($teamspeakrow["serverip"])." und Port: ".$dbconnect->HtmlEscape($teamspeakrow["sshport"])." herstellen.";
						}
					}else{
						if(mkdir("admin/ownmodules/uploadinstances")){
							move_uploaded_file($_FILES["fileurl"]["tmp_name"], "admin/ownmodules/uploadinstances/".$dbconnect->HtmlEscape($_FILES["fileurl"]["name"]));
							$true = "Das File wurde hochgeladen, und wird jetzt entpackt.";
						}else{
							$false = "Das Verzeichnis konnte nicht angelegt werden.";
						}
					}
				}
			}else{
				$false = "Du kannst nur .tar.gz hochladen.";
			}
		}else{
			$false = "Tippen sie alle Felder mit einem (*) ein.";
		}
	break;
}	
	
	$adminmsg = admin_title("cmodules", ""._TEAMSPEAK."", ""._ASSISTENTAPPLIST."", $iconset, "");
	echo ''.$adminmsg.'';
	
	include ("templates/teamspeaknode/teamspeakinstanceupload.php");
    include ("admin/footer.php");
}

switch ($op) {
	
	case "adminteamspeakinstanceupload":
	admintest($ids, $test, $save);
	break;

}
}else{
adminLogin($admin);
}

?>