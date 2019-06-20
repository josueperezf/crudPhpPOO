<?php 
class Db
{
	private static $instance=NULL;
	
	function __construct(){}

	public static function  getConnect()
	{
		$dbname		='bodega';
		$host		='localhost';
		$user		='root';
		$password	='';
		$mostrarErrores="0";
		//puede ser pgsql para postgres o mysql para mysql
		$tipoDatabase='mysql';
		if (!isset(self::$instance)) {
			$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
			//self::$instance= new PDO('mysql:host=localhost;dbname=bodega','root','',$pdo_options);
			try {
			if($mostrarErrores)
				self::$instance= new PDO("$tipoDatabase:dbname=$dbname;host=$host", $user, $password,$pdo_options);
			else
				self::$instance= new PDO("$tipoDatabase:dbname=$dbname;host=$host", $user, $password);
			} catch (PDOException $e) {
				if($mostrarErrores)
					print "¡Error!: " . $e->getMessage() . "<br/>";
				http_response_code(500);
				die();
			}
		} 
		return self::$instance;
	}
}

 ?>