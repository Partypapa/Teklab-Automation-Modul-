<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>Teamspeak-Modul</title>
        <meta name="generator" content="server-verleih" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
		
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
        </style>	
    </head>
<body>
<form action="admin.php?op=adminteamspeaktsdns&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>" method="post">
<div class="container">
	<ul class="nav nav-pills">
		<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Server-Verwaltung</a></li>
		<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=backupcreate">Backup erstellen</a></li>
		<li><a href="admin.php?op=adminteamspeakbackuplist&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Backup einspielen</a></li>
		<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=resetserverperm">Server-Permissions Reset</a></li>
		<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=start">Server starten</a></li>
		<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=stop">Server stoppen</a></li>
		<li><a href="admin.php?op=adminteamspeakvirtualserver&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Virtualserver erstellen</a></li>
		<li class="active"><a href="admin.php?op=adminteamspeakvirtualserveredit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Virtualserver verwalten</a></li>
	</ul>
</div>

<br />
<div class="container">
	<ul class="nav nav-pills">
		<li><a href="admin.php?op=adminteamspeaktsdns&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">TSDNS Eintr&auml;ge</a></li>
		<li><a href="#">TSDNS Eintr&auml;ge Verwalten</a></li>
		<li><a href="#">TSDNS starten</a></li>
		<li><a href="#">TSDNS stoppen </a></li>
		<li><a href="admin.php?op=adminteamspeaknodes">Zur&uuml;ck zur Node-&Uuml;bersicht</a></li>
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


<?php if($dbconnect->NumRows($dbconnect->RunQuery("SELECT * FROM teamspeak_virtualserver")) > 0){ ?>
<div class="container">
    <div class="panel panel-default">
	<div class="panel-heading">Teamspeakserver-Virtualserver (non-imported - imported)</div>
	<table class="table">
        <thead>
          <tr>
            <th>ID</th>
			<th>Virtualservername</th>
			<th>Virtualserverip</th>
			<th>Virtualserverport</th>
			<th>Virtualserverslots</th>
			<th>Virtualserverstatus</th>
			<th>Rootserverauswahl</th>
			<th>Kunde</th>
			<th>Gesperrt</th>
			<th>Aktionen</th>
          </tr>
        </thead>
        <tbody>	
		<tr>
			<?php $query = $dbconnect->RunQuery("SELECT id, name, teamspeakip, teamspeakport, slots, rootserverauswahl, kunden, gesperrt FROM teamspeak_virtualserver");
			while($row = $dbconnect->FetchAssoc()){ ?>
			
			<?php 
				try {
					$dbconnect->RunQuery("SELECT teamspeakip, teamspeakpassword FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["edit"])."");
					$teamspeakrow = $dbconnect->FetchAssoc();
					
					$ts3 = TeamSpeak3::factory("serverquery://serveradmin:".$dbconnect->HtmlEscape($teamspeakrow["teamspeakpassword"])."@".$dbconnect->HtmlEscape($teamspeakrow["teamspeakip"]).":10011/?server_port=9987");
					$ts3virtualserver = $ts3->serverSelectByPort($row["teamspeakport"]);
					
					if($ts3virtualserver["virtualserver_status"] == "online"){
						$teamspeakstatus = "online";
					}else{
						$teamspeakstatus = "offline";
					}
					
				}catch(Exception $ex){
					$false = $ex->getMessage();
				}
			?>
				<td><?php echo $dbconnect->HtmlEscape($row["id"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($row["name"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($row["teamspeakip"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($row["teamspeakport"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($row["slots"]);?></td>
				<td><img src="admin/ownmodules/images/<?php echo $dbconnect->HtmlEscape($teamspeakstatus);?>.png"></td>
				<td><?php echo $dbconnect->HtmlEscape($row["rootserverauswahl"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($row["kunden"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($row["gesperrt"]);?></td>
				<td><a href="admin.php?op=virtualserverid&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($row["id"]);?>"><img src="admin/ownmodules/images/edit.png"></a> <a href="admin.php?op=virtualserverid&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&virtualserveriddelete=<?php echo $dbconnect->HtmlEscape($row["id"]);?>"><img src="admin/ownmodules/images/delete.png"></a></td>
			</tr>
			<?php } ?>
	    </tbody>
      </table>
	</div>
  </div>
</div>
<?php } else { ?>
	<div class="container"><div class="alert alert-danger">Zurzeit existieren keine Virtualserver.</div></div>
<?php } ?>
</body>
</div>
</html>