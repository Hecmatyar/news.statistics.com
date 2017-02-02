<?php 
include_once('../base/Db.php');
include('../views/graph.php');
$data = Graph::getAllResource();
echo $data;
?>