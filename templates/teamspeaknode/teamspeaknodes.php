<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>Teamspeak-Modul</title>
        <meta name="generator" content="server-verleih" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
		
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		
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
<div class="container">
	<ul class="nav nav-pills">
		<li><a href="admin.php?op=adminteamspeak">Teamspeak-Packages installieren</a></li>
		<li class="active"><a href="admin.php?op=adminteamspeaknodes">Teamspeak-Nodes</a></li>
		<li><a href="admin.php?op=adminteamspeaktekbaseimport">Vorhandene Teamspeak-Grundserver von Tekbase &uuml;bernehmen</a></li>
	</ul>
</div>

<br />
<?php if(isset($true)){ ?>
	<div class="alert alert-danger"><?php echo $true;?></div>
<?php } ?>

<?php if(isset($false)){ ?>
	<div class="alert alert-danger"><?php echo $false;?></div>
<?php } ?>

<div class="container">
  <?php if($dbconnect->NumRows($dbconnect->RunQuery("SELECT * FROM teamspeak_nodes")) > 0){ ?>
  <div class="panel panel-default">
  <div class="panel-heading">Teamspeaknodes-Verwalten</div>
    <table class="table">
        <thead>
          <tr>
            <th>Teamspeakid</th>
            <th>Teamspeakip</th>
            <th>Teamspeakusername</th>
			<th>Teamspeakpassword</th>
			<th>Teamspeakstatus</th>
			<th>Error-Debug</th>
			<th>Node-Imported</th>
			<th>Node-Pfad</th>
			<th>Rootserverauswahl</th>
			<th>Aktionen</th>
          </tr>
        </thead>
        <tbody>
		<?php $query = $dbconnect->RunQuery("SELECT * FROM teamspeak_nodes");
			while($row = $dbconnect->FetchAssoc()){ 
				$random = new Random();
				
				if($row["nodeimported"] == 1)
				{
					$nodeimported = "online.png";
				}
				else
				{
					$nodeimported = "offline.png";
				}
				
				/* Teamspeak-Status */
				try {
					$ts3_ServerInstance = TeamSpeak3::factory("serverquery://serveradmin:".$dbconnect->HtmlEscape($row["teamspeakpassword"])."@".$dbconnect->HtmlEscape($row["teamspeakip"]).":".$dbconnect->HtmlEscape($row["queryport"])."/?server_port=".$dbconnect->HtmlEscape($row["voiceport"])."&blocking=0");
					$ts3serverinstance = $ts3_ServerInstance->serverGetByPort($ts3_ServerInstance["virtualserver_port"]);
			
				}catch(Exception $ex){
					if($row["teamspeaknodedebuggingerror"] == 0){
						/* kein debugging */
					}else{
						echo $ex->getMessage();
					}
				}
			?>
          <tr>
            <td><?php echo $dbconnect->HtmlEscape($row["id"]);?></td>
            <td><?php echo $dbconnect->HtmlEscape($row["teamspeakip"]);?></td>
            <td><?php echo $dbconnect->HtmlEscape($row["teamspeakusername"]);?></td>
			<td><?php echo $dbconnect->HtmlEscape($row["teamspeakpassword"]);?></td>
			<td><?php if($ts3serverinstance["virtualserver_status"] == "online"){ ?> <img src="admin/ownmodules/images/online.png"> <?php } else { ?>  <img src="admin/ownmodules/images/offline.png"> <?php } ?></td>
			<td><?php if($row["teamspeaknodedebuggingerror"] == 0){ ?> <a href="admin.php?op=teamspeakerrordebug&edit=<?php echo $dbconnect->HtmlEscape($row["id"]);?>&api=updatettsdebuggingerroron">Debug an</a></td><?php } else { ?><a href="admin.php?op=teamspeakerrordebug&edit=<?php echo $dbconnect->HtmlEscape($row["id"]);?>&api=updatettsdebuggingerroroff">Debug aus</a></td><?php } ?>
			<td><img src="admin/ownmodules/images/<?php echo $dbconnect->HtmlEscape($nodeimported);?>"></td>
			<td><?php echo $dbconnect->HtmlEscape($row["nodepfad"]);?></td>
			<td><?php echo $dbconnect->HtmlEscape($row["rootserverauswahl"]);?></td>
			<td><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($row["id"]);?>"><img src="admin/ownmodules/images/edit.png"></a> <a href="admin.php?op=adminteamspeaknodesedit&delete=<?php echo $dbconnect->HtmlEscape($row["id"]);?>"><img src="admin/ownmodules/images/delete.png"></a></td>
		 </tr>	
		 <?php } ?>
        </tbody>
      </table>
	</div>
</div>
<?php } else { ?>
	<div class="alert alert-danger">Zurzeit sind keine Teamspeak-Nodes vorhanden</div>
<?php } ?>
</body>
</html>