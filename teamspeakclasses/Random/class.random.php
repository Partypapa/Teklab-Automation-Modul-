<?php
/* Copyright by Steekarlkani */
class Random {
	public function pingServer($target)
	{ 
		$result = array();
	    $cmd_result = shell_exec("ping -c 1 -w 1 ". $target);
	 
	    $result = explode(",", $cmd_result);
		foreach($result as $k => $value)
		{
			echo"<pre>".htmlspecialchars($value)."</pre>";
		}
	}
	
	public function generateQueryPassword()
	{
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$password = array(); 
		$alphaLength = strlen($alphabet) - 1; 
		
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$password[] = $alphabet[$n];
		}
   
		return implode($password);
	}

	public function conv_traffic($bytes)
	{
		if ($bytes<1024)
		{
			$ret=$bytes."Bytes";
		}
		elseif($bytes<1048576)
		{
			$ret=round(($bytes/1024), 2)."KiB";
		}
		elseif($bytes<1073741824)
		{
			$ret=round(($bytes/1048576), 2)."MiB";
		}
		elseif($bytes<1099511627776)
		{
			$ret=round(($bytes/1073741824), 2)."GiB";
		}
		
		return $ret;
	}
	
	public function convert_traffic($bytes)
	{
		if ($bytes<1024)
		{
			$ret=$bytes;
		}
		elseif($bytes<1048576)
		{
			$ret=round(($bytes/1024), 2);
		}
		elseif($bytes<1073741824)
		{
			$ret=round(($bytes/1048576), 2);
		}
		elseif($bytes<1099511627776)
		{
			$ret=round(($bytes/1073741824), 2);
		}
		
		return $ret;
	}
}
?>