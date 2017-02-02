<?php 
include_once('../base/Db.php');
include('../views/graph.php');
$code= $_POST['datecode'];
$data = Graph::getMainGraph($code);
echo $data;
?>