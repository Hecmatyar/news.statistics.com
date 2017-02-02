<?php 

//FRONT CONTROLLER
//1.Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);


//2.Подключение файлов системы
define('ROOT',dirname(__FILE__));
require_once(ROOT.'/views/controller.php');


//3.Установка соединения с БД
include_once(ROOT.'/base/Db.php');

$controller = new Control();
$controller->action();
 ?>