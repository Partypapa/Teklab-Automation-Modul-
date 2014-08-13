<?php
ini_set('display_errors', 0);
error_reporting(0);

class Database extends PDO {
	private $hostname;
	private $username;
	private $password;
	private $db;
	private $dbconnect;
	
	private $query;
	
	public function __construct($hostname, $username, $password, $db){
		$this->hostname = $hostname;
		$this->username = $username;
		$this->password = $password;
		$this->db = $db;
	}
	
	public function connectDB(){
		try {
			$this->dbconnect = new PDO('mysql:host='.$this->hostname.';dbname='.$this->db.'', $this->username, $this->password);
			$this->checkBlacklisted($_SERVER["HTTP_HOST"], $_SERVER["SERVER_ADDR"]);
		
		}catch(PDOException $ex){
			die("<center><h3>PDO-Error: ".$ex->getMessage()."</center></h3>");
		}
	}
	
	private function checkBlacklisted($domain, $ip)
	{	
		/* curl check */
		if(extension_loaded("curl")){
			$init = curl_init();
			curl_setopt($init, CURLOPT_URL, "http://server-verleih.org/blacklisted.php?domain=".$this->HtmlEscape($domain)."&ip=".$this->HtmlEscape($ip)."");
			curl_setopt($init, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($init, CURLOPT_TIMEOUT, 3);
			curl_setopt($init, CURLOPT_HEADER, false);
			$exec = curl_exec($init);
		
			if($exec == true){
				if($exec == "Blacklisted."){
					die($exec);
				}else{
					return false;
				}
			}else{
				die("CURL-Error: ".curl_error($init)."");
			}
		}else{
			die("Bitte installieren sie CURL, um dieses Skript benutzen zu können");
		}
		
		return false;
	}
	
	public function RunQuery($querydata){
		$this->query = $this->dbconnect->query($querydata);
		
		if (!$this->query) {
			die(print_r($this->dbconnect->errorInfo()));
		}
		
		return $this->query;
	}
	
	public function NumRows(){
		return $this->query->rowCount();
	}
	
	public function FetchAssoc(){
		return $this->query->fetch(PDO::FETCH_ASSOC);
	}	
	
	public function Escape($quote){
		return $this->dbconnect->quote($quote);
	}
	
	public function HtmlEscape($escape){
		return htmlspecialchars($escape);
	}
}
?>