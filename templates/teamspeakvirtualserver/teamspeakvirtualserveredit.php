<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>Teamspeak-Modul</title>
        <meta name="generator" content="server-verleih" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
       
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		
		<link rel="stylesheet" href="admin/ownmodules/ts3viewer/css/tsstatus.css">
		<script src="admin/ownmodules/ts3viewer/js/tsstatus.js"></script>
		
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- CSS code from Bootply.com editor -->
        <style type="text/css">
        header {
			margin-bottom:30px;
		}
			
		h2 {
			margin-top:-23px;
		}
        </style>	
    </head>
<body>
<script type="text/javascript">
$(document).ready(function(){
	$(".virtualserverstatus").popover({
		html: true,
		trigger: 'focus',
		show: 500,
		hide: 100
	});
});
</script>

<div class="container">
  <ul class="nav nav-pills">
		<?php if(isset($_GET["edit"])){ ?>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Server-Verwaltung</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=channelrechtebackupcreate">Channel-Rechte-Backup erstellen</a></li>
			<li><a href="admin.php?op=adminteamspeakbackuplist&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Channel-Rechte-Backup einspielen</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=resetserverperm">Server-Permissions Reset</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=start">Server starten</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=stop">Server stoppen</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=restart">Server restart</a></li>
		<?php } elseif(isset($_GET["delete"])){ ?>
			<li class="active"><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Server-Verwaltung</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>&api=channelrechtebackupcreate">Channel-Rechte-Backup erstellen</a></li>
			<li><a href="admin.php?op=adminteamspeakbackuplist&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Channel-Rechte-Backup einspielen</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>&api=resetserverperm">Server-Permissions Reset</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>&api=start">Server starten</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>&api=stop">Server stoppen</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>&api=restart">Server restart</a></li>
		<?php } ?>
	</ul>
</div>

<br />
<div class="container">
	<ul class="nav nav-pills">
		<?php if(isset($_GET["edit"])){ ?>
			<li><a href="admin.php?op=adminteamspeakvirtualserver&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Virtualserver erstellen</a></li>
			<li class="active"><a href="admin.php?op=adminteamspeakvirtualserveredit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Virtualserver verwalten</a></li>
			<li><a href="admin.php?op=adminteamspeaktsdns&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">TSDNS Einträge</a></li>
			<li><a href="admin.php?op=adminteamspeaktsdnsverwaltung&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">TSDNS Einträge Verwalten</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsstart">TSDNS starten</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsstop">TSDNS stoppen </a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsrestart">TSDNS Restart </a></li>
			<li><a href="admin.php?op=adminteamspeaknodes">Zurück zur Node-Übersicht</a></li>
		<?php } elseif(isset($_GET["delete"])){ ?>
			<li><a href="admin.php?op=adminteamspeakvirtualserver&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Virtualserver erstellen</a></li>
			<li class="active"><a href="admin.php?op=adminteamspeakvirtualserveredit&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Virtualserver verwalten</a></li>
			<li><a href="admin.php?op=adminteamspeaktsdns&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">TSDNS Einträge</a></li>
			<li><a href="admin.php?op=adminteamspeaktsdnsverwaltung&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">TSDNS Einträge Verwalten</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>&api=tsdnsstart">TSDNS starten</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>&api=tsdnsstop">TSDNS stoppen </a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>&api=tsdnsrestart">TSDNS Restart </a></li>
			<li><a href="admin.php?op=adminteamspeaknodes">Zurück zur Node-Übersicht</a></li>
		<?php } ?>
	</ul>
</div>

<br />
<div class="container">
	<ul class="nav nav-pills">
		<?php if(isset($_GET["edit"])){ ?>
			<li><a href="admin.php?op=adminteamspeaktrafficviewer&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Traffic-Viewer</a></li>
		<?php } elseif(isset($_GET["delete"])){ ?>
			<li><a href="admin.php?op=adminteamspeaktrafficviewer&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Traffic-Viewer</a></li>
		<?php } ?>
	</ul>
</div>

<br />
<div class="container">
	<?php if(isset($true)){ ?>
		<br /> <div class="alert alert-success"><?php echo $dbconnect->HtmlEscape($true);?></div>
	<?php } ?>
	
	<?php if(isset($false)){ ?>
		<br /> <div class="alert alert-danger"><?php echo $dbconnect->HtmlEscape($false);?></div>
	<?php } ?>
</div>


<div class="container">
    <div class="panel panel-default">
	<div class="panel-heading">Teamspeakserver-Virtualserver-Verwaltung (<?php echo $dbconnect->HtmlEscape($dbconnect->RunQuery("SELECT COUNT(id) FROM teamspeak_virtualserver")->fetchColumn());?>)</div>
	<table class="table">
        <thead>
          <tr>
            <th>ID</th>
			<th>Virtualservername</th>
			<th>Virtualserverport</th>
			<th>Virtualserverslots</th>
			<th>Virtualserverstatus</th>
			<th>Aktionen</th>
          </tr>
        </thead>
        <tbody>	
		<tr>
			<?php 
				$dbconnect->RunQuery("SELECT teamspeakip, teamspeakpassword, queryport FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["edit"])."");
				$teamspeakrow = $dbconnect->FetchAssoc();
				
				$tserver = array();
				$dbconnect->RunQuery("SELECT * FROM teamspeak_virtualserver");
				while($row = $dbconnect->FetchAssoc()){
					$tserver = $row;
				}
				
				$tsadmin = new ts3admin($teamspeakrow["teamspeakip"], $teamspeakrow["queryport"]);
					
				if($tsadmin->getElement('success', $tsadmin->connect())){
					/* Teamspeak-Connect */
					$tsadmin->login("serveradmin", $teamspeakrow["teamspeakpassword"]);
					$serverlist = $tsadmin->getElement('data', $tsadmin->serverList());
				}else{
					die("Fehler beim Verbinden zum Teamspeak-Grundserver");
				}
			?>
			
			<?php foreach($serverlist as $server){ $conv_time = $tsadmin->convertSecondsToArrayTime($server['virtualserver_uptime']); ?>
				<td><?php echo $dbconnect->HtmlEscape($server["virtualserver_id"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($server["virtualserver_name"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($server["virtualserver_port"]);?></td>
				<td><a href="#" data-container="body" class="virtualserverstatus" data-toggle="popover" data-content="<?php if(empty($server["virtualserver_clientsonline"])){echo"0";}else{ echo $dbconnect->HtmlEscape($server["virtualserver_clientsonline"]);};?>/<?php if(empty($tserver["slots"])){ echo $dbconnect->HtmlEscape($server["virtualserver_maxclients"]); }else{ echo $dbconnect->HtmlEscape($tserver["slots"]);}?> <br /> <?php echo $dbconnect->HtmlEscape($conv_time["days"]);?> Tage <?php echo $dbconnect->HtmlEscape($conv_time["hours"]);?> Stunden  <br /> <?php echo $dbconnect->HtmlEscape($conv_time["minutes"]);?> Minuten <?php echo $dbconnect->HtmlEscape($conv_time["seconds"]);?> Sekunden" title="<?php echo $dbconnect->HtmlEscape($server["virtualserver_name"]);?>"><?php if(empty($tserver["slots"])){ echo $dbconnect->HtmlEscape($server["virtualserver_maxclients"]); }else{ echo $dbconnect->HtmlEscape($tserver["slots"]);}?></a></td>
				<td><a href="#" data-container="body" class="virtualserverstatus" data-toggle="popover" data-content="<?php if($server["virtualserver_status"] == "online"){echo"Online";}else{echo"Offline";};?>" title="<?php echo $dbconnect->HtmlEscape($server["virtualserver_name"]);?>"><?php if($server["virtualserver_status"] == "online"){ echo"<img src=\"admin/ownmodules/images/online.png\">";}else{echo"<img src=\"admin/ownmodules/images/offline.png\">";};?></a></td>
				<td><?php if(empty($tserver)){ echo"<a href=\"admin.php?op=adminteamspeaknodesedit&edit=".$dbconnect->HtmlEscape($_GET["edit"])."\"><img src=\"admin/ownmodules/images/edit.png\"></a>";  echo"<a href=\"admin.php?op=adminteamspeaknodesedit&delete=".$dbconnect->HtmlEscape($_GET["edit"])."\"> <img src=\"admin/ownmodules/images/delete.png\"></a>";}else { echo"<a href=\"admin.php?op=adminteamspeakvirtualservereditform&nodehost=".$dbconnect->HtmlEscape($_GET["edit"])."&virtualserverid=".$dbconnect->HtmlEscape($tserver["id"])."&tsid=".$dbconnect->HtmlEscape($server["virtualserver_id"])."\"><img src=\"admin/ownmodules/images/edit.png\"></a>";};?></td>
				</tr> 
			<?php } ?> 
	    </tbody> 
      </table> 
	</div> 
  </div> 
</div> 
</body> 
</div> 
</html>    