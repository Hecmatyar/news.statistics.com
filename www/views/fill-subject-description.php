<?php 
$resource_array = $_POST['description'];
echo '<p>Описание</p>';
echo '<span class= "head-desc">Словарь</span>';
echo '<span class= "s-desc">'.$resource_array['name'].'</span>';
echo '<span class= "head-desc">Описание</span>';
echo '<span class= "s-desc">'.$resource_array['attitude'].'</span>';
	
?>