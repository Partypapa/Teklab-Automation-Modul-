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
		
		}catch(PDOException $ex){
			die("<center><h3>PDO-Error: ".$ex->getMessage()."</center></h3>");
		}
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