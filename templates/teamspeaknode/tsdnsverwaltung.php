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
<div class="container">
  <ul class="nav nav-pills">
		<?php if(isset($_GET["edit"]) || isset($_GET["nodehost"])){ ?>
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
		<?php if(isset($_GET["edit"]) || isset($_GET["nodehost"])){ ?>
			<li><a href="admin.php?op=adminteamspeakvirtualserver&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Virtualserver erstellen</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualserveredit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Virtualserver verwalten</a></li>
			<li><a href="admin.php?op=adminteamspeaktsdns&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">TSDNS Einträge</a></li>
			<li class="active"><a href="admin.php?op=adminteamspeaktsdnsverwaltung&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">TSDNS Einträge Verwalten</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsstart">TSDNS starten</a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsstop">TSDNS stoppen </a></li>
			<li><a href="admin.php?op=adminteamspeaknodesedit&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&api=tsdnsrestart">TSDNS Restart </a></li>
			<li><a href="admin.php?op=adminteamspeaknodes">Zurück zur Node-Übersicht</a></li>
		<?php } elseif(isset($_GET["delete"])){ ?>
			<li><a href="admin.php?op=adminteamspeakvirtualserver&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Virtualserver erstellen</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualserveredit&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Virtualserver verwalten</a></li>
			<li><a href="admin.php?op=adminteamspeaktsdns&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">TSDNS Einträge</a></li>
			<li class="active"><a href="admin.php?op=adminteamspeaktsdnsverwaltung&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">TSDNS Einträge Verwalten</a></li>
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
		<?php if(isset($_GET["edit"]) || isset($_GET["nodehost"])){ ?>
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

<?php if($dbconnect->NumRows($dbconnect->RunQuery("SELECT * FROM teamspeak_nodes_tsdns")) > 0){ ?>
<div class="container">
    <div class="panel panel-default">
	<div class="panel-heading">TSDNS-Eintr&auml;ge verwalten</div>
	<table class="table">
        <thead>
          <tr>
            <th>ID</th>
			<th>TSDNS Eintrag</th>
			<th>Rootserverauswahl</th>
			<th>Aktionen</th>
          </tr>
        </thead>
        <tbody>	
		<tr>
			<?php $query = $dbconnect->RunQuery("SELECT id, tsdnseintrag, rootserverauswahl FROM teamspeak_nodes_tsdns");
			while($row = $dbconnect->FetchAssoc()){ ?>
				<td><?php echo $dbconnect->HtmlEscape($row["id"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($row["tsdnseintrag"]);?></td>
				<td><?php echo $dbconnect->HtmlEscape($row["rootserverauswahl"]);?></td>
				<td><a href="admin.php?op=adminteamspeaktsdnsverwaltung&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>&tsdnsid=<?php echo $dbconnect->HtmlEscape($row["id"]);?>"><img src="admin/ownmodules/images/delete.png"></a></td>
			</tr>
			<?php } ?>
	    </tbody>
      </table>
	</div>
  </div>
</div>
<?php } else { ?>
	<div class="container"><div class="alert alert-danger">Zurzeit existieren keine TSDNS-Eintr&aumlge.</div></div>
<?php } ?>
</body>
</div>
</html>