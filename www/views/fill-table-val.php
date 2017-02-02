<?php 
$resource_array = explode(",", $_POST['border']);

echo '<div class="table-value"><table class="table"><thead><tr><th>№</th><th>Диапазон</th><th>Описание</th></tr></thead><tbody>';	
		echo "<tr><td>1</td><td> < ".$resource_array[0]."</td>";	
		echo "<td>Интерес отсутсвует</td></tr>";	
		echo "<tr><td>2</td><td>".$resource_array[0].' - '.$resource_array[1]."</td>";	
		echo "<td>Низкий интерес</td></tr>";
		echo "<tr><td>3</td><td>".$resource_array[1].' - '.$resource_array[2]."</td>";	
		echo "<td>Средний интерес</td></tr>";
		echo "<tr><td>4</td><td>".$resource_array[2].' - '.$resource_array[3]."</td>";	
		echo "<td>Высокий интерес</td></tr>";
		echo "<tr><td>5</td><td> > ".$resource_array[3]."</td>";	
		echo "<td>Информационное цунами</td></tr>";
echo '</tbody></table></div>';
?>