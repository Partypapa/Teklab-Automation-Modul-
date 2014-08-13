<?php
/* Copyright by Steekarlkani */

session_start();

class SSH {
	public $connect;
	public $ip;
	public $port;
	public $debug;
	
	public function __construct($ip, $port)
	{
		$this->ip = $ip;
		$this->port = $port;
	}
	
	public function setDebugMode($debug)
	{
		$this->debug = $debug;
	}
	
	public function login($username, $password)
	{	
		try {
			if($this->connect = ssh2_connect($this->ip, $this->port)){
				if(ssh2_auth_password($this->connect, $username, $password)){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
	}
	
	public function debug()
	{
		if($this->debug == true){
			return true;
		}else{
			return false;
		}
	}
	
	public function execute($command)
	{
		try {
			if($this->stream = ssh2_exec($this->connect, $command)){
				stream_set_blocking($this->stream, true);
				
				while($buf = fread($this->stream, 4096)){
					$this->data .= $buf;
				}
				
				if($this->debug() == true){
					print_r($this->data);
				}
	
				fclose($stream);
				return true;
			}else{
				return false;
			}	
		
		}catch(Exception $ex){
			die($ex->getMessage());
		}
	}
	
	public function UploadFile($filename)
	{
		try {
			$resSFTP = ssh2_sftp($this->connect);
			$file = $filename;
			
			if($contents = file_get_contents("admin/ownmodules/uploadinstances/".$file."")){
				if(file_put_contents("ssh2.sftp://{$resSFTP}/home/user-webi/{$file}", $contents)){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
			
			fclose($resSFTP);
			fclose($contents);
			fclose($this->connect);
		
		}catch(Exception $ex){
			die($ex->getMessage());
		}
	}

	public function DaemonExists()
	{
		try {
			$resSFTP = ssh2_sftp($this->connect);
			
			if(file_exists("ssh2.sftp://{$resSFTP}/home/skripte/daemon")){
				return true;
			}else{
				return false;
			}
		
		
		}catch(Exception $ex){
			die($ex->getMessage());
		}
	}
}
?>