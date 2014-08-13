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
		<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=channelrechtebackupcreate">Channel-Rechte-Backup erstellen</a></li>
		<li><a href="admin.php?op=adminteamspeakbackuplist&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Channel-Rechte-Backup einspielen</a></li>
		<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=resetserverperm">Server-Permissions Reset</a></li>
		<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=start">Server starten</a></li>
		<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=stop">Server stoppen</a></li>
		<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=restart">Server restart</a></li>
	</ul>
</div>

<br />
<div class="container">
	<ul class="nav nav-pills">
		<li><a href="admin.php?op=adminteamspeakvirtualserver&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Virtualserver erstellen</a></li>
		<li><a href="admin.php?op=adminteamspeakvirtualserveredit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Virtualserver verwalten</a></li>
		<li class="active"><a href="admin.php?op=adminteamspeaktsdns&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">TSDNS Einträge</a></li>
		<li><a href="admin.php?op=adminteamspeaktsdnsverwaltung&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">TSDNS Eintr&auml;ge Verwalten</a></li>
		<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsstart">TSDNS starten</a></li>
		<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsstop">TSDNS stoppen </a></li>
		<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsrestart">TSDNS Restart </a></li>
		<li><a href="admin.php?op=adminteamspeaknodes">Zurück zur Node-Übersicht</a></li>
	</ul>
</div>

<br />
<div class="container">
	<ul class="nav nav-pills">
		<li><a href="admin.php?op=adminteamspeakvirtualserver&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Servernachricht schreiben</a></li>
		<li><a href="admin.php?op=adminteamspeaktrafficviewer&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Traffic-Viewer</a></li>
	</ul>
</div>

<br />
<div class="container">
	<br /> 
	<?php if(isset($false)){ ?>
		<div class="alert alert-danger"><?php echo $dbconnect->HtmlEscape($false);?></div>
	<?php } ?>
	
	<?php if(isset($true)){ ?>
		<div class="alert alert-success"><?php echo $dbconnect->HtmlEscape($true);?></div>
	<?php } ?>
</div>


<div class="container">
	<div class="panel panel-default">
	<div class="panel-heading">TSDNS-Eintr&auml;ge</div>
	<div class="panel-body">
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="ip" class="form-control" placeholder="IP-Adresse - (*)">
		</div>
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="port" class="form-control" placeholder="Port - (*)">
		</div>
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="subdomain" class="form-control" placeholder="Domain oder Subdomain - (*)">
		</div> 	
		
		
		<br /><input type="submit" class="btn btn-default" formaction="admin.php?op=adminteamspeaktsdns&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=save" formmethod="post" name="submit" value="Speichern">
	</div></div>
</div>
</form>
</body>
</div>
</html>