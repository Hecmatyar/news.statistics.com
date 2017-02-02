<?php 
$newlist = $_POST['allresource'];
$resource_array = explode(",", $_POST['myres']);

echo '<div class="table-value"><table class="abbreviation-table table"><thead><tr><th>Сокращение</th><th>Влияние</th><th>Название</th><th>Ссылка</th></tr></thead><tbody>';	
$i=1;
foreach ($newlist as $newItem){		
	if(in_array($newItem['namemin'], $resource_array)){
		echo "<tr>";		
		echo "<td>".$newItem['namemin']."</td>";	
		echo "<td>".$newItem['effect']."</td>";
		echo "<td>".$newItem['name']."</td>";	
		echo "<td><a href='".$newItem['address']."'>Перейти</a></td></tr>";		
		$i++;
	}
}
echo '</tbody></table></div>';
?>