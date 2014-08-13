<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="iso-8859-1">
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
<br />
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
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Server-Verwaltung</a></li>
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
			<li class="active"><a href="admin.php?op=adminteamspeakvirtualserver&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Virtualserver erstellen</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualserveredit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Virtualserver verwalten</a></li>
			<li><a href="admin.php?op=adminteamspeaktsdns&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">TSDNS Einträge</a></li>
			<li><a href="admin.php?op=adminteamspeaktsdnsverwaltung&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">TSDNS Einträge Verwalten</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsstart">TSDNS starten</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsstop">TSDNS stoppen </a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsrestart">TSDNS Restart </a></li>
			<li><a href="admin.php?op=adminteamspeaknodes">Zurück zur Node-Übersicht</a></li>
		<?php } elseif(isset($_GET["delete"])){ ?>
			<li class="active"><a href="admin.php?op=adminteamspeakvirtualserver&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Virtualserver erstellen</a></li>
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
			<li><a href="admin.php?op=adminteamspeaktrafficviewer&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Traffic-Viewer</a></li>
		<?php } elseif(isset($_GET["delete"])){ ?>
			<li><a href="admin.php?op=adminteamspeaktrafficviewer&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Traffic-Viewer</a></li>
		<?php } ?>
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


<?php if($ts3serverinstance["virtualserver_status"] == "online"){ ?>
<div class="container">
	<div class="panel panel-default">
	<div class="panel-heading">Teamspeakvirtualserver - Erstellen</div>
	<div class="panel-body">
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="name" class="form-control" placeholder="Virtualservername - (*)">
		</div>
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="port" class="form-control" placeholder="Port - (*)">
		</div>
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="slots" class="form-control" placeholder="Slots - (*)">
		</div> 	
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="hostbuttontooltip" class="form-control" placeholder="Hostbuttontooltip  - (Optional)">
		</div> 	
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="hostbuttontooltipurl" class="form-control" placeholder="Hostbuttontooltipurl  - (Optional)">
		</div> 	
		
		<br />
		
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<input type="text" name="hostbuttongfxurl" class="form-control" placeholder="Hostbuttongfxurl  - (Optional)">
		</div> 	
		
		<h3>Bitte wählen sie einen Kunden aus:</h3>
		<div class="input-group input-group-lg">
			<span class="input-group-addon">@</span>
			<select name="kundenauswahl" class="form-control">
				<?php $dbconnect->RunQuery("SELECT member FROM teklab_members");
				while($member = $dbconnect->FetchAssoc()){ ?>
					<option value="<?php echo $dbconnect->HtmlEscape($member["member"]);?>"><?php echo $dbconnect->HtmlEscape($member["member"]);?></option>
				<?php } ?>
			</select>
		</div> 	

		
		<br /><input type="submit" class="btn btn-default" formaction="admin.php?op=adminteamspeakvirtualserver&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=save" formmethod="post" name="submit" value="Speichern">
	</div></div>
</div>
</form>
</body>
</div>
<?php } else { ?>
	<div class="container"><div class="alert alert-danger">Du kannst dein Server erst verwalten wenn er Online ist.</div></div>
<?php } ?>
</html>