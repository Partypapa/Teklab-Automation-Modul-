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
        </style>	
    </head>
<body>
<form action="admin.php?op=adminteamspeak" method="post">
<div class="container">
	<ul class="nav nav-pills">
		<li class="active"><a href="admin.php?op=adminteamspeak">Teamspeak-Packages installieren</a></li>
		<li><a href="admin.php?op=adminteamspeaknodes">Teamspeak-Nodes</a></li>
		<li><a href="admin.php?op=adminteamspeaktekbaseimport">Vorhandene Teamspeak-Grundserver von Tekbase übernehmen</a></li>
	</ul>
</div>

<div class="container" style="margin-top:30px;border-radius:10px;">
		<?php if(isset($false)){ ?>
			<div class="alert alert-danger"><?php echo $dbconnect->HtmlEscape($false);?></div>
		<?php } ?>
			
		<?php if(isset($true)){ ?>
			<div class="alert alert-success"><?php echo $dbconnect->HtmlEscape($true);?></div>
		<?php } ?>
		      
	<div class="alert alert-warning">Achtung: Nach dem sie auf den Button geklickt haben, dauert dies eine Weile die Seite darf nicht geschlossen werden da es von selbst passiert.</div>
	
	<div class="jumbotron">
		<h2>Automatische Installation von den Teamspeak-Packages</h2>
		<p>Das Modul von mir installiert alles bequem automatisch.</p>
		
		<br />
		
		<h2>Verwaltung via Tekbase</h2>
		<p>Einfache Verwaltung via Tekbase und für ihre Kunden ebenfalls.</p>
		
		<br />
		
		<h2>Installation</h2>
		<p>Wählen sie denn Rootserver aus auf dem das Modul installiert werden soll.</p>
		<p>Achtung: Die Installation dauert 2 - 5 Minuten klicken sie diese Seite nicht weg!</p>
		
		<?php if($dbconnect->NumRows($dbconnect->RunQuery("SELECT name FROM teklab_rootserver")) > 0){ ?>
		<p>Bitte wählen sie ihr Rootserver aus:</p>
			<select name="rootserverauswahl" id="rootserverauswahl" class="form-control">
				<?php $query = $dbconnect->RunQuery("SELECT name FROM teklab_rootserver");
					while($row = $dbconnect->FetchAssoc()){ ?>
						<option value="<?php echo $dbconnect->HtmlEscape($row["name"]);?>"><?php echo $dbconnect->HtmlEscape($row["name"]);?></option>
					<?php } ?>
			</select>
		
		<div style="margin-top:10px;">
			<input type="submit" name="start" formaction="admin.php?op=adminteamspeak&api=installteamspeak" formmethod="post" class="btn btn-default navbar-btn" value="Install Teamspeak">
			<input type="submit" name="back"  formaction="admin.php?op=adminMain" formmethod="post" class="btn btn-default navbar-btn" value="Zurück zur Dashboard">
		</div>
	</div>
	<?php } else {  ?>
		<p>Zurzeit sind keine Rootserver vorhanden, binde welche ein um dein Teamspeakserver zu verwalten</p>
	<?php } ?>
</div>
</form>
</body>
</html>