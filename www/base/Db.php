<?php 
/**
* подключение и работа с БД
*/
class Db
{
	
	function __construct()
	{
		
	}

	public static function getConnection(){
		$paramsPath = 'db_params.php';
		$params = include($paramsPath);

		$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
		$db = new PDO($dsn, $params['user'],$params['password'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

		return $db;	
	}
}
 ?>