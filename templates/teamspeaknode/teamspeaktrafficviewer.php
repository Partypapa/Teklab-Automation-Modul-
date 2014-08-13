<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>Teamspeak-Modul</title>
        <meta name="generator" content="server-verleih" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  
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
		
		#container {
			height: 400px; 
			min-width: 310px; 
			max-width: 800px;
			margin: 0 auto;
		}
        </style>	
    </head>
<body>
<?php 
	$dbconnect->RunQuery("SELECT id, teamspeakip, teamspeakusername, teamspeakpassword, rootserverauswahl, nodeimported, nodepfad, queryport, voiceport FROM teamspeak_nodes WHERE id = ".$dbconnect->Escape($_GET["edit"])."");
	$row = $dbconnect->FetchAssoc();
			
	try {
		$ts3_ServerInstance = TeamSpeak3::factory("serverquery://serveradmin:".$dbconnect->HtmlEscape($row["teamspeakpassword"])."@".$dbconnect->HtmlEscape($row["teamspeakip"]).":".$dbconnect->HtmlEscape($row["queryport"])."/?server_port=".$dbconnect->HtmlEscape($row["voiceport"])."");
		$ts3serverinstance = $ts3_ServerInstance->serverGetByPort($ts3_ServerInstance["virtualserver_port"]);
		
		$bytes_total_gesendet = $dbconnect->HtmlEscape($random->conv_traffic($ts3serverinstance["connection_bytes_sent_total"]));
		$bytes_total_empfangen = $dbconnect->HtmlEscape($random->conv_traffic($ts3serverinstance["connection_bytes_received_total"]));
		
		$bytes_total_empfangen_keepalive = $dbconnect->HtmlEscape($random->conv_traffic($ts3serverinstance["connection_bytes_received_keepalive"]));
		$bytes_total_gesendet_keepalive = $dbconnect->HtmlEscape($random->conv_traffic($ts3serverinstance["connection_bytes_sent_keepalive"]));
		
		$packet_total_keepalive_gesendet = $dbconnect->HtmlEscape($random->conv_traffic($ts3serverinstance["connection_packets_sent_keepalive"]));
		$packets_total_keepalive_empfangen = $dbconnect->HtmlEscape($random->conv_traffic($ts3serverinstance["connection_packets_received_keepalive"]));
		
	
	}catch(Exception $ex){
		$ex = "";
	}			
?>
<script type="text/javascript">
$(function (){
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
			title: {
                text: 'Teamspeakserver-Traffic-Viewer'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: '',
            },
            series: [{
                name: 'Bytes',
                data: [
					['Bytes gesendet <?php echo $bytes_total_gesendet;?>', <?php echo $dbconnect->HtmlEscape($random->convert_traffic($ts3serverinstance["connection_bytes_sent_total"]));?>],
                    ['Bytes empfangen <?php echo $bytes_total_empfangen;?>', <?php echo $dbconnect->HtmlEscape($random->convert_traffic($ts3serverinstance["connection_bytes_received_total"]));?>],
					['Bytes empfangen (keepalive) <?php echo $bytes_total_empfangen_keepalive;?>', <?php echo $dbconnect->HtmlEscape($random->convert_traffic($ts3serverinstance["connection_bytes_received_keepalive"]));?>],
					['Bytes gesendet (keepalive) <?php echo $bytes_total_gesendet_keepalive;?>', <?php echo $dbconnect->HtmlEscape($random->convert_traffic($ts3serverinstance["connection_bytes_sent_keepalive"]));?>],

					['Packete empfangen (keepalive) <?php echo $packets_total_keepalive_empfangen;?>', <?php echo $dbconnect->HtmlEscape($random->convert_traffic($ts3serverinstance["connection_packets_received_keepalive"]));?>],
                	['Packete gesendet (keepalive) <?php echo $packet_total_keepalive_gesendet;?>', <?php echo $dbconnect->HtmlEscape($random->convert_traffic($ts3serverinstance["connection_packets_received_keepalive"]));?>],
				],
				
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    x: 4,
                    y: 10,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif',
                        textShadow: '0 0 3px black'
                    }
                }
            }]
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
			<li class="active"><a href="admin.php?op=adminteamspeaktrafficviewer&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Traffic-Viewer</a></li>
		<?php } elseif(isset($_GET["delete"])){ ?>
			<li class="active"><a href="admin.php?op=adminteamspeaktrafficviewer&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Traffic-Viewer</a></li>
		<?php } ?>
	</ul>
</div>


<br /> 
<div class="container">
    <div class="panel panel-default">
		<div class="panel-heading">Teamspeakserver-Traffic-Viewer</div>
		<script src="admin/ownmodules/js/highcharts.js"></script>
		<script src="admin/ownmodules/js/highcharts-3d.js"></script>
		<script src="admin/ownmodules/js/modules/exporting.js"></script>

		<div id="container" style="height: 400px"></div>
	</div></div></div>
</body>
</div>
</html>