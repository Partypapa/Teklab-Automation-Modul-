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
<form action="admin.php?op=adminteamspeakinstanceupload" method="post" enctype="multipart/form-data">
<div class="container">
	<ul class="nav nav-pills">
		<li><a href="admin.php?op=adminteamspeak">Teamspeak-Packages installieren</a></li>
		<li class="active"><a href="admin.php?op=adminteamspeakinstanceupload">Teamspeak-Instance Upload</a></li>
		<li><a href="admin.php?op=adminteamspeaknodes">Teamspeak-Nodes</a></li>
	</ul>
</div>

<div class="container" style="margin-top:30px;border-radius:10px;">
		<?php if(isset($false)){ ?>
			<div class="alert alert-danger"><?php echo $dbconnect->HtmlEscape($false);?></div>
		<?php } ?>
			
		<?php if(isset($true)){ ?>
			<div class="alert alert-success"><?php echo $dbconnect->HtmlEscape($true);?></div>
		<?php } ?>
		      
	<div class="alert alert-warning">Achtung: Nach dem sie auf den Button geklickt haben, dauert dies eine Weile die Seite darf nicht geschlossen werden.</div>
	
	<div class="jumbotron">
		<div style="margin-top:-20px;">
		<p>Bitte w&auml;hlen sie ihren Rootserver aus:</p>
			<select name="rootserverauswahl" id="rootserverauswahl" class="form-control">
				<?php $query = $dbconnect->RunQuery("SELECT name FROM teklab_rootserver");
					while($row = $dbconnect->FetchAssoc()){ ?>
					<option value="<?php echo $dbconnect->HtmlEscape($row["name"]);?>"><?php echo $dbconnect->HtmlEscape($row["name"]);?></option>
				<?php } ?>
			</select>
			
			<div style="margin-top:10px;">
			<p>Bitte wählen sie ihr File aus</p>
				<input type="hidden" name="FILE" />
				<input type="file" name="fileurl">
			</div>
			
			<div style="margin-top:10px;">
				<input type="submit" name="start" formaction="admin.php?op=adminteamspeakinstanceupload&api=uploadinstance" formmethod="post" class="btn btn-default navbar-btn" value="Upload Instance">
				<input type="submit" name="back"  formaction="admin.php?op=adminMain" formmethod="post" class="btn btn-default navbar-btn" value="Zur&uuml;ck zum Dashboard">
			</div>
		</div>
	</div>
</div>
</form>
</body>
</html>