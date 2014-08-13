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
function HideModul(modulhide, modulshow)
{
	$("#"+modulhide+"").modal("hide");
	showModul(modulshow);
}

function showModul(modulshow)
{
	$("#"+modulshow+"").modal("show");
}
</script>

<div class="container">
  <ul class="nav nav-pills">
		<?php if(isset($_GET["nodehost"])){ ?>
			<li class="active"><a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($row["id"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>">Virtualserver verwalten</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($row["id"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>&api=channelrechtebackupcreate">Channel-Rechte-Backup erstellen</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($row["id"]);?>">Channel-Rechte-Backup einspielen</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($row["id"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>&api=resetserverperm">Server-Permissions Reset</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($row["id"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>&api=start">Server starten</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($row["id"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>&api=stop">Server stoppen</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($row["id"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>&api=restart">Server restart</a></li>
		<?php } elseif(isset($_GET["delete"])){ ?>
			<li><a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($row["id"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>&api=channelrechtebackupcreate">Channel-Rechte-Backup erstellen</a></li>
			<li><a href="admin.php?op=adminteamspeakbackuplist&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Channel-Rechte-Backup einspielen</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($row["id"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>&api=resetserverperm">Server-Permissions Reset</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($row["id"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>&api=start">Server starten</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($row["id"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>&api=stop">Server stoppen</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($row["id"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>&api=restart">Server restart</a></li>
		<?php } ?>
	</ul>
</div>

<br />
<div class="container">
	<ul class="nav nav-pills">
		<?php if(isset($_GET["nodehost"])){ ?>
			<li><a href="#" data-toggle="modal" data-target="#servernachricht">Servernachricht schreiben</a></li>
			<li><a href="admin.php?op=adminteamspeaktrafficviewer&edit=<?php echo $dbconnect->HtmlEscape($_GET["edit"]);?>">Traffic-Viewer</a></li>
			<li><a href="#" data-toggle="modal" data-target="#ts3viewer">TS-Viewer</a></li>
			<li><a href="#" data-toggle="modal" data-target="#serverlogs">TS-Serverlogs</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualserveredit&edit=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>">Zur&uuml;ck zur Virtualserver-&Uuml;bersicht</a></li>		<?php } elseif(isset($_GET["delete"])){ ?>
			<li><a href="#" data-toggle="modal" data-target="#servernachricht">Servernachricht schreiben</a></li>
			<li><a href="admin.php?op=adminteamspeaktrafficviewer&edit=<?php echo $dbconnect->HtmlEscape($_GET["delete"]);?>">Traffic-Viewer</a></li>
			<li><a href="#" data-toggle="modal" data-target="#ts3viewer">TS-Viewer</a></li>
			<li><a href="#" data-toggle="modal" data-target="#serverlogs">TS-Serverlogs</a></li>
			<li><a href="admin.php?op=adminteamspeakvirtualserveredit&edit=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>">Zur&uuml;ck zur Virtualserver-&Uuml;bersicht</a></li>
		<?php } ?>
	</ul>
</div>

<div class="container">
		<?php if(isset($false)){  ?>
			<br /> <div class="alert alert-danger"><?php echo $dbconnect->HtmlEscape($false);?></div> 
		<?php } ?>
	
	
		<?php if(isset($true)){ ?>
			<br /> <div class="alert alert-success"><?php echo $dbconnect->HtmlEscape($true);?></div> 
		<?php } ?>
</div>

<br />
<div class="container">
		<?php if($info['data']['virtualserver_status'] == "online"){ ?>
			<div class="list-group">
			<a href="#" class="list-group-item disabled">
				Serverinfo
			</a>
		
			<a href="#" class="list-group-item">virtualserver_id: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_id']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_unique_identifier: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_unique_identifier']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_name: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_name']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_welcomemessage: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_welcomemessage']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_platform: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_platform']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_version: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_version']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_maxclients: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_maxclients']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_password: <?php if(empty($info['data']['virtualserver_password'])){ echo"Keins gesetzt";}else{ echo $dbconnect->HtmlEscape($info['data']['virtualserver_password']);};?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_clientsonline: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_clientsonline']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_channelsonline: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_channelsonline']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_created: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_created']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_uptime: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_uptime']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_codec_encryption_mode: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_codec_encryption_mode']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_hostmessage: <?php if(empty($info['data']['virtualserver_password'])){ echo"Keine Nachricht";}else{ echo $dbconnect->HtmlEscape($info['data']['virtualserver_hostmessage']);};?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_hostmessage_mode: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_hostmessage_mode']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_filebase: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_filebase']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_default_server_group: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_default_server_group']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_default_channel_group: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_default_channel_group']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_flag_password: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_flag_password']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_default_channel_admin_group: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_default_channel_admin_group']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_max_download_total_bandwidth: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_max_download_total_bandwidth']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_max_upload_total_bandwidth: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_max_upload_total_bandwidth']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_hostbanner_url: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_hostbanner_url']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_hostbanner_gfx_url: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_hostbanner_gfx_url']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_hostbanner_gfx_interval: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_hostbanner_gfx_interval']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_complain_autoban_count: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_complain_autoban_count']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_complain_autoban_time: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_complain_autoban_time']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_complain_remove_time: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_complain_remove_time']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_min_clients_in_channel_before_forced_silence: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_min_clients_in_channel_before_forced_silence']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_priority_speaker_dimm_modificator: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_priority_speaker_dimm_modificator']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_antiflood_points_tick_reduce: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_antiflood_points_tick_reduce']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_antiflood_points_needed_command_block: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_antiflood_points_needed_command_block']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_antiflood_points_needed_ip_block: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_antiflood_points_needed_ip_block']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_client_connections: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_client_connections']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_query_client_connections: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_query_client_connections']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_hostbutton_tooltip: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_hostbutton_tooltip']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_hostbutton_url: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_hostbutton_url']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_hostbutton_gfx_url: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_hostbutton_gfx_url']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_queryclientsonline: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_queryclientsonline']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_download_quota: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_download_quota']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_upload_quota: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_upload_quota']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_month_bytes_downloaded: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_month_bytes_downloaded']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_month_bytes_uploaded: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_month_bytes_uploaded']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_total_bytes_downloaded: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_total_bytes_downloaded']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_total_bytes_uploaded: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_total_bytes_uploaded']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_port: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_port']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_autostart: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_autostart']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_machine_id: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_machine_id']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_needed_identity_security_level: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_needed_identity_security_level']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_log_client: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_log_client']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_log_query: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_log_query']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_log_channel: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_log_channel']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_log_permissions: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_log_permissions']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_log_server: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_log_server']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_log_filetransfer: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_log_filetransfer']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_min_client_version: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_min_client_version']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_name_phonetic: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_name_phonetic']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_icon_id: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_icon_id']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_reserved_slots: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_reserved_slots']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_total_packetloss_speech: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_total_packetloss_speech']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_total_packetloss_keepalive: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_total_packetloss_keepalive']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_total_packetloss_control: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_total_packetloss_control']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_total_packetloss_total: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_total_packetloss_total']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_total_ping: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_total_ping']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_ip: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_ip']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_weblist_enabled: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_weblist_enabled']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_ask_for_privilegekey: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_ask_for_privilegekey']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_hostbanner_mode: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_hostbanner_mode']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_channel_temp_delete_delay_default: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_channel_temp_delete_delay_default']);?></a>
			<br />
			<a href="#" class="list-group-item">virtualserver_status: <?php echo $dbconnect->HtmlEscape($info['data']['virtualserver_status']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_filetransfer_bandwidth_sent: <?php echo $dbconnect->HtmlEscape($info['data']['connection_filetransfer_bandwidth_sent']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_filetransfer_bandwidth_received: <?php echo $dbconnect->HtmlEscape($info['data']['connection_filetransfer_bandwidth_received']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_filetransfer_bytes_sent_total: <?php echo $dbconnect->HtmlEscape($info['data']['connection_filetransfer_bytes_sent_total']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_filetransfer_bytes_received_total: <?php echo $dbconnect->HtmlEscape($info['data']['connection_filetransfer_bytes_received_total']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_packets_sent_speech: <?php echo $dbconnect->HtmlEscape($info['data']['connection_packets_sent_speech']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_bytes_sent_speech: <?php echo $dbconnect->HtmlEscape($info['data']['connection_bytes_sent_speech']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_packets_received_speech: <?php echo $dbconnect->HtmlEscape($info['data']['connection_packets_received_speech']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_bytes_received_speech: <?php echo $dbconnect->HtmlEscape($info['data']['connection_bytes_received_speech']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_packets_sent_keepalive: <?php echo $dbconnect->HtmlEscape($info['data']['connection_packets_sent_keepalive']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_packets_received_keepalive: <?php echo $dbconnect->HtmlEscape($info['data']['connection_packets_received_keepalive']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_bytes_received_keepalive: <?php echo $dbconnect->HtmlEscape($info['data']['connection_bytes_received_keepalive']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_packets_sent_control: <?php echo $dbconnect->HtmlEscape($info['data']['connection_packets_sent_control']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_bytes_sent_control: <?php echo $dbconnect->HtmlEscape($info['data']['connection_bytes_sent_control']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_packets_received_control: <?php echo $dbconnect->HtmlEscape($info['data']['connection_packets_received_control']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_bytes_received_control: <?php echo $dbconnect->HtmlEscape($info['data']['connection_bytes_received_control']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_packets_sent_total: <?php echo $dbconnect->HtmlEscape($info['data']['connection_packets_sent_total']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_bytes_sent_total: <?php echo $dbconnect->HtmlEscape($info['data']['connection_bytes_sent_total']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_packets_received_total: <?php echo $dbconnect->HtmlEscape($info['data']['connection_packets_received_total']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_bytes_received_total: <?php echo $dbconnect->HtmlEscape($info['data']['connection_bytes_received_total']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_bandwidth_sent_last_second_total: <?php echo $dbconnect->HtmlEscape($info['data']['connection_bandwidth_sent_last_second_total']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_bandwidth_sent_last_minute_total: <?php echo $dbconnect->HtmlEscape($info['data']['connection_bandwidth_sent_last_minute_total']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_bandwidth_received_last_second_total: <?php echo $dbconnect->HtmlEscape($info['data']['connection_bandwidth_received_last_second_total']);?></a>
			<br />
			<a href="#" class="list-group-item">connection_bandwidth_received_last_minute_total: <?php echo $dbconnect->HtmlEscape($info['data']['connection_bandwidth_received_last_minute_total']);?></a>
			<br />
		</div>
	</div>
<?php } ?>

<?php if($info['data']['virtualserver_status'] == "online"){ ?>
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
	
		<input type="submit" formaction="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($_GET["virtualserverid"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>&api=save" formmethod="post" class="btn btn-default" name="tsubmit" value="Speichern">
	</div></div>
</div>
</div>

<?php if($servergroup["data"] > 0){  ?>
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
			<?php
				$servergroup = $tsadmin->getElement('data', $tsadmin->serverGroupList());
				foreach($servergroup AS $key => $value){ ?>
					<td><?php echo $dbconnect->HtmlEscape($value["sgid"]);?></td>
					<td><?php echo $dbconnect->HtmlEscape($value["name"]);?></td>
					<td><?php echo $dbconnect->HtmlEscape($value["type"]);?></td>
					<td><?php echo $dbconnect->HtmlEscape($value["iconid"]);?></td>
					<td><?php echo $dbconnect->HtmlEscape($value["savedb"]);?></td>
					<td><a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($_GET["virtualserverid"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>&servergroupid=<?php echo $dbconnect->HtmlEscape($value["sgid"]);?>&api=tokencreate">Token erstellen</a></td>
			</tr>
			<?php } ?>
	    </tbody>
      </table>
	</div>
  </div>
</div>
<?php } ?>

<?php if($tokenlist["data"] > 0){  ?>
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
			<?php
				$tokenlist = $tsadmin->getElement('data', $tsadmin->tokenList());
				foreach($tokenlist AS $key => $value){ ?>
					<td><?php echo $dbconnect->HtmlEscape($value["token"]);?></td>
					<td><?php echo $dbconnect->HtmlEscape($value["token_type"]);?></td>
					<td><?php echo $dbconnect->HtmlEscape($value["token_id1"]);?></td>
					<td><?php echo $dbconnect->HtmlEscape($value["token_id2"]);?></td>
					<td><?php echo $dbconnect->HtmlEscape(date("D.M.Y:H:i:s", $tokenlist["token_created"]));?></td>
					<td><?php echo $dbconnect->HtmlEscape($value["token_description"]);?></td>
					<td><a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($_GET["virtualserverid"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>&token=<?php echo $dbconnect->HtmlEscape($value["token"]);?>&api=tokendelete">Token löschen</a> <a href="admin.php?op=adminteamspeakvirtualservereditform&nodehost=<?php echo $dbconnect->HtmlEscape($_GET["nodehost"]);?>&virtualserverid=<?php echo $dbconnect->HtmlEscape($_GET["virtualserverid"]);?>&tsid=<?php echo $dbconnect->HtmlEscape($_GET["tsid"]);?>&api=tokendeleteall">Alle Tokens löschen</a> </td>
				</tr>
			<?php } ?>
	    </tbody>
      </table>
	</div>
  </div>
</div>
<?php } ?>


</form>
<?php } else { ?>
	<div class="alert alert-danger">Du kannst dein Server erst verwalten wenn er Online ist.</div>
<?php } ?>
</html>
</body>