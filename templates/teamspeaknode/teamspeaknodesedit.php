<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>Teamspeak-Modul</title>
        <meta name="generator" content="server-verleih" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.css">
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
		
		label {
			display: inline-block;
			width: 5em;
		}
        </style>	
    </head>
<body>
<script type="text/javascript">
$(document).ready(function(){
	$(".channelviewer").popover({
		html: true,
		trigger: 'focus',
		show: 500,
		hide: 100
	});
	
	$(".userviewer").popover({
		html: true,
		trigger: 'focus',
		show: 500,
		hide: 100
	});
});
</script>

<script type="text/javascript">
function HideModul(modulhide, modulshow, clientid, clientname, selectdiv)
{
	$("#"+modulhide+"").modal("hide");
	showModul(modulshow);
	setClientID(selectdiv, clientid, clientname);
}

function showModul(modulshow)
{
	$("#"+modulshow+"").modal("show");
}

function setClientID(selectdiv, clientid, clientname)
{
	$("#"+selectdiv+"").html("<option value="+clientid+">"+clientname+"</option>");
}
</script>

<div class="container">
  <ul class="nav nav-pills">
		<?php if(isset($_GET["edit"])){ ?>
			<li class="active"><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Server-Verwaltung</a></li>
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
			<li><a href="admin.php?op=adminteamspeakvirtualserveredit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Virtualserver verwalten</a></li>
			<li><a href="admin.php?op=adminteamspeaktsdns&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">TSDNS Einträge</a></li>
			<li><a href="admin.php?op=adminteamspeaktsdnsverwaltung&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">TSDNS Einträge Verwalten</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsstart">TSDNS starten</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsstop">TSDNS stoppen </a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsrestart">TSDNS Restart </a></li>
			<li><a href="admin.php?op=adminteamspeaknodes">Zurück zur Node-Übersicht</a></li>
		<?php } elseif(isset($_GET["delete"])){ ?>
			<li><a href="admin.php?op=adminteamspeakvirtualserver&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Virtualserver erstellen</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualserveredit&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Virtualserver verwalten</a></li>
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
			<li><a href="#" data-toggle="modal" data-target="#servernachricht">Servernachricht schreiben</a></li>
			<li><a href="admin.php?op=adminteamspeaktrafficviewer&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Traffic-Viewer</a></li>
			<li><a href="#" data-toggle="modal" data-target="#ts3viewer">TS-Viewer</a></li>
			<li><a href="#" data-toggle="modal" data-target="#serverlogs">TS-Serverlogs</a></li>
		<?php } elseif(isset($_GET["delete"])){ ?>
			<li><a href="#" data-toggle="modal" data-target="#servernachricht">Servernachricht schreiben</a></li>
			<li><a href="admin.php?op=adminteamspeaktrafficviewer&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Traffic-Viewer</a></li>
			<li><a href="#" data-toggle="modal" data-target="#ts3viewer">TS-Viewer</a></li>
			<li><a href="#" data-toggle="modal" data-target="#serverlogs">TS-Serverlogs</a></li>
		<?php } ?>
	</ul>
</div>

<form action="" method="post">
<?php if($row["query_ip_whitelist_angepasst"] == 0){ ?>
<div class="modal fade" id="queryipwhitelist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Whitelist File anpassen</h4>
      </div>
      <div class="modal-body">
        <div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="webserverip" class="form-control" placeholder="Webserverip - (*)">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
        <input type="submit" name="submit" formaction="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>" formmethod="post" class="btn btn-primary" value="Speichern">
      </div>
    </div>
  </div>
</div>
<?php } ?>

<div class="modal fade" id="ts3serverini" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">TS3-Server.ini Konfiguration</h4>
      </div>
      <div class="modal-body">
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="voiceserverip" class="form-control" placeholder="Voiceserverip - (*)">
		</div>
		
		<br />
		
        <div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="voiceserverport" class="form-control" placeholder="Voiceserverport - (*)">
		</div>
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="filetransfer_port" class="form-control" placeholder="Filetransferport - (*)">
		</div>
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="filetransfer_ip" class="form-control" placeholder="Filetransferip - (*)">
		</div>
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="query_ip" class="form-control" placeholder="Queryip (*)">
		</div>
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="query_port" class="form-control" placeholder="Queryport - (*)">
		</div>
		<br />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
        <input type="submit" name="tsubmith" formaction="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=createts3serverini" formmethod="post" class="btn btn-primary" value="Speichern">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="kickuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">User-Kicken</h4>
      </div>
      <div class="modal-body">
		<div class="input-group input-group-lg">
			<select id="kickclientid" name="kickclientid" class="form-control"></select>
		</div>
		
		<br />
		
        <div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="kickmessage" class="form-control" placeholder="Nachricht - (*)">
		</div>
		
		<br />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
        <input type="submit" name="tkickuser" formaction="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=kickuser" formmethod="post" class="btn btn-primary" value="Kicken">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="pokeuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">User-Anstupsen</h4>
      </div>
      <div class="modal-body">
		<div class="input-group input-group-lg">
			<select id="clientid" name="clientid" class="form-control"></select>
		</div>
		
		<br />
		
        <div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="message" class="form-control" placeholder="Nachricht - (*)">
		</div>
		
		<br />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
        <input type="submit" name="tpokesubmit" formaction="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=pokeuser" formmethod="post" class="btn btn-primary" value="Anstupsen">
      </div>
    </div>
  </div>
</div>

<br />

<div class="modal fade" id="banuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">User-Bannen</h4>
      </div>
      <div class="modal-body">
		<div class="input-group input-group-lg">
			<select id="clid" name="clid" class="form-control"></select>
		</div>
		
		<br />
		
        <div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="timeseconds" class="form-control" placeholder="Zeit - (*)">
		</div>
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="reason" class="form-control" placeholder="Grund - (*)">
		</div>
		
		<br />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
        <input type="submit" name="tbansubmit" formaction="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=banuser" formethod="post" class="btn btn-primary" value="Bannen">
      </div>
    </div>
  </div>
</div>

<br />

<div class="modal fade" id="moveuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">User-Ziehen</h4>
      </div>
      <div class="modal-body">
		<div class="input-group input-group-lg">
			<select id="moveclid" name="moveclid" class="form-control"></select>
		</div>
		
		<br />
		
		<div class="input-group input-group-lg">
			<select id="movecid" name="movecid" class="form-control">
				<?php
					try {
						if($ts3serverinstance["virtualserver_status"] == "online"){
							foreach($ts3serverinstance->channelList() as $channel)
							{
								echo"<option value=\"".$dbconnect->HtmlEscape($channel["cid"])."\">".$dbconnect->HtmlEscape($channel["channel_name"])."</option>";
							}
						}else{
							if($row["teamspeaknodedebuggingerror"] == 0){
								/* Kein Debugging */
							}else{
								$false = $ex->getMessage();
							}
						}
					}catch(Exception $ex){
						die($ex->getMessage());
					}
				?>
			</select>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
        <input type="submit" name="tmovesubmit" formaction="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=moveuser" formethod="post" class="btn btn-primary" value="Move">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ts3viewer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">TS-Viewer</h4>
      </div>
      <div class="modal-body">
	    <?php
			try {
				if($ts3serverinstance["virtualserver_status"] == "online"){ 
					/* Viewer starten */
					$ts3viewer = new TSStatus($row["teamspeakip"], $row["queryport"], 1);
					$ts3viewer->useServerPort($row["voiceport"]);
					$ts3viewer->setLoginPassword($row["teamspeakusername"], $row["teamspeakpassword"]);
			
					/* Config festlegen */
					$ts3viewer->imagePath = "admin/ownmodules/ts3viewer/img/";
					$ts3viewer->showNicknameBox = false;
					$ts3viewer->showPasswordBox = false;
				
					$ts3viewer->clearServerGroupFlags();
					$ts3viewer->setServerGroupFlag(6, 'servergroup_300.png');
					$ts3viewer->clearChannelGroupFlags();
			
					$ts3viewer->setChannelGroupFlag(5, 'changroup_100.png');
					$ts3viewer->setChannelGroupFlag(6, 'changroup_200.png');
				
					$ts3viewer->timeout = 2;			
					$ts3viewer->decodeUTF8 = true;
			
					$ts3viewer->setCache(5);
					$ts3viewer->setCache(5, "admin/ownmodules/ts3viewer/tmp/ts3viewerchace.cache");
		
					$ts3viewer->hideEmptyChannels = false;
					$ts3viewer->hideParentChannels = false;
			
					echo $ts3viewer->render();
				}else{
					echo"Dein Teamspeakserver ist derzeit Offline, versuche es später wieder.";
				}
			}catch(Exception $ex){
				if($row["teamspeaknodedebuggingerror"] == 0){
					/* Kein Debugging */
				}else{
					$false = $ex->getMessage();
				}
			}
		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="servernachricht" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Servernachricht schreiben</h4>
      </div>
      <div class="modal-body">
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="servernachricht" class="form-control" placeholder="Servernachricht schreiben - (*)">
		</div>
      </div>
      <div class="modal-footer">
		<input type="submit" name="servertsubmit" formaction="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=sendservernachricht" formmethod="post" class="btn btn-default" value="Schicken">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="tokenerstellen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Token erstellen</h4>
      </div>
      <div class="modal-body">
			<select id="channelgroup" name="channelgroup" class="form-control">
			
			
			</select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="serverlogs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Serverlogs</h4>
      </div>
      <div class="modal-body">
		<?php 
			if($ts3serverinstance["virtualserver_status"] == "online"){
				try {
					foreach($ts3serverinstance->logView(30, 0) as $logs)
					{
						echo"<br /> Logs: ".$dbconnect->HtmlEscape($logs["l"])."<br />";
					}
				
				}catch(Exception $ex){
					if($row["teamspeaknodedebuggingerror"] == 0){
						/* kein debugging */
					}else{
						$false = $ex->getMessage();
					}
				}
			}else{
				echo"Dein Teamspeakserver ist derzeit Offline, versuche es später wieder.";
			}
		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
		<?php if(isset($false)){  ?>
			<div class="alert alert-danger"><?php echo $dbconnect->HtmlEscape($false);?></div> 
		<?php } ?>
		
		<?php if($ts3serverinstance["virtualserver_status"] == "online"){ ?>
			<?php if(isset($version)){ ?>
				<br /> <div class="alert alert-info"><?php echo $dbconnect->HtmlEscape($version);?></div> 
			<?php } ?>
		<?php } ?>
	
		<?php if(isset($true)){ ?>
			<br /> <div class="alert alert-success"><?php echo $dbconnect->HtmlEscape($true);?></div> 
		<?php } ?>
		
		<?php if(!isset($tsserver)){ ?>
			<?php if($row["query_ip_whitelist_angepasst"] == 0){ ?>
				<br /> <div class="alert alert-danger">Bitte passen sie das Query_IP_Whitelist File hier an, sonst kann es zu einem Dauerbann führen: <a href="#" data-toggle="modal" data-target="#queryipwhitelist">Query_IP_Whitelist File anpassen</a></div>
			<?php } ?>
		<?php } ?>
		
		<?php if($ts3serverinstance["virtualserver_status"] == "online"){ ?>
			<br /><div class="alert alert-info"> Hier können sie die <a href="#" data-toggle="modal" data-target="#ts3serverini">TS3-Server.ini anpassen</a></div>
		<?php } ?>
</div>

<?php if(isset($_GET["edit"])){ ?>
<?php if($ts3serverinstance["virtualserver_status"] == "online"){ ?>
<div class="container">
    <div class="panel panel-default">
	<div class="panel-heading">Teamspeakserver-Serverinfo</div>
	<table class="table">
        <thead>
          <tr>
            <th>Indent</th>
            <th>Value</th>
          </tr>
        </thead>
        <tbody>	
		<tr>
		<?php foreach($ts3serverinstance->getInfo(TRUE, TRUE) as $ident => $value){ ?>
			<td><?php echo $dbconnect->HtmlEscape($ident);?></td>
			<td><?php echo $dbconnect->HtmlEscape($value);?></td>
			</tr>
		<?php } ?>
	    </tbody>
      </table>
	</div>
  </div>
</div>
<?php } ?>

<?php if($ts3serverinstance["virtualserver_status"] == "online"){ ?>
<form action="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>" method="post">
<div class="container">
	<div class="panel panel-default">
	<div class="panel-heading">Teamspeakserver-Bearbeiten</div>
	<div class="panel-body">
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="name" class="form-control" placeholder="Teamspeakserver-Name - (*)">
		</div>
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="welcomemessage" class="form-control" placeholder="Willkommensnachricht - (Optional)">
		</div> 	
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="password" name="password" class="form-control" placeholder="Serverpassword - (Optional)">
		</div> 	
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="hostbannerurl" class="form-control" placeholder="Hostbanner-URL - (Optional)">
		</div> 	
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="hostbannergfxurl" class="form-control" placeholder="Hostbanner-GFX-Url - (Optional)">
		</div> 	
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<select name="hostbannermode" class="form-control">
				<option value="0">Nicht Anpassen</option>
				<option value="1">Anpassen, Seitenverhaeltnis ignorieren</option>
				<option value="2">Anpassen, Seitenverhaeltnis beachten</option>
			</select>
		</div> 	
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="hostbuttontooltip" class="form-control" placeholder="Hostbutton-Tooltip - (Optional)">
		</div> 	
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="hostbuttonurl" class="form-control" placeholder="Hostbutton-URL - (Optional)">
		</div> 	
		
		<br />
	
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="hostbuttongfxurl" class="form-control" placeholder="Hostbutton-GFX-Url - (Optional)">
		</div> 	
		
		<br />
	
		<input type="submit" formaction="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=save" formmethod="post" class="btn btn-default" name="tsubmit" value="Speichern">
	</div></div>
</div>
</form>

<?php if($ts3serverinstance->serverGroupList() > 0){  ?>
<div class="container">
    <div class="panel panel-default">
	<div class="panel-heading">Teamspeakserver-Servergrouplist</div>
	<table class="table">
        <thead>
          <tr>
		  	<th>Servergroupid</th>
            <th>Servergroupname</th>
            <th>Servergrouptype</th>
			<th>Servergroupiconid</th>
			<th>Servergroupsavedb</th>
			<th>Aktionen</th>
          </tr>
        </thead>
        <tbody>	
		<tr>
			<?php foreach($ts3serverinstance->serverGroupList() as $servergrouplist){?>
				<td><?php echo $dbconnect->HtmlEscape($servergrouplist["sgid"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($servergrouplist["name"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($servergrouplist["type"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($servergrouplist["iconid"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($servergrouplist["savedb"]);?></td>
				<td><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&tokenid=<?php echo $dbconnect->HtmlEscape($servergrouplist["sgid"]);?>&api=tokencreate">Token erstellen</a></td>
			</tr>
			<?php } ?>
	    </tbody>
      </table>
	</div>
  </div>
</div>
<?php } ?>


<?php if($ts3serverinstance->tokenList() > 0){ ?>
<div class="container">
    <div class="panel panel-default">
	<div class="panel-heading">Teamspeakserver-Tokenlist</div>
	<table class="table">
        <thead>
          <tr>
		  	<th>Servertoken</th>
            <th>Servertokentype</th>
            <th>Servertokenid1</th>
			<th>Servertokenid2</th>
			<th>Servertokencreated</th>
			<th>Servertokendescription</th>
			<th>Aktionen</th>
          </tr>
        </thead>
        <tbody>	
		<tr>
			<?php foreach($ts3serverinstance->tokenList() as $tokenlist){ ?>
				<td><?php echo $dbconnect->HtmlEscape($tokenlist["token"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($tokenlist["token_type"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($tokenlist["token_id1"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($tokenlist["token_id2"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape(date("D.M.Y:H:i:s", $tokenlist["token_created"]));?></td>
				<td><?php echo $dbconnect->HtmlEscape($tokenlist["token_description"]);?></td>
				<td><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&token=<?php echo $dbconnect->HtmlEscape($tokenlist["token"]);?>&api=tokendelete">Token löschen</a> <a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&token=<?php echo $dbconnect->HtmlEscape($tokenlist["token"]);?>&api=tokendeleteall">Alle Tokens löschen</a></td>
			</tr>
			<?php } ?>
	    </tbody>
      </table>
	</div>
  </div>
</div>
<?php } ?>

<?php } else { ?>
	<div class="container"><div class="alert alert-danger">Du kannst dein Server erst verwalten wenn er Online ist.</div></div>
<?php }  ?>
<?php } ?>
</body>
</div>
</html>