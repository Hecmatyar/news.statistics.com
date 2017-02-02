<?php 
$resource_array = $_POST['dictionary'];
$i = 0;
$out = array_keys($resource_array);
foreach ($resource_array as $item){
	echo '<div class="msrItem">';	
	echo '<span class= "head-sub" id='.$out[$i].'>'.$out[$i].'</span>';
	foreach ($item as $sub){
		echo '<span class= "d smooth" id='.$sub['id'].'>'.$sub['name'].'<span>';
	}
	echo '</div>';
	$i++;
}		
?>