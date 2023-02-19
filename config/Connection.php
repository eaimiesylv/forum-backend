<?php

class Connection{
	
	private $host="localhost";
	private $database="forum";
	private $user="root";
	private $password="";
	private static $instance;
	public $cons=null;

	
	
	public static function getInstance(){
		if (!isset(self::$instance)) {
			$dns="mysql:host=localhost;dbname=forum";
			try{
				self::$instance = new PDO($dns,"root","");
				
				
			}
			catch(\Exception $e){
				echo "Connection Error $e<br>";
			}
			
		}
		
		return self::$instance;
	}
	
}



