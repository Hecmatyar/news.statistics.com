<?php 
$newlist = $_POST['allresource'];
$resource_array = explode(",", $_POST['myres']);
echo "<div class='note flex'><span style='margin: auto;'>Список опрашиваемых ресурсов:</span></div>";	
foreach ($newlist as $newItem){		
	if(in_array($newItem['namemin'], $resource_array)){
		echo "<div class='resource-site flex'>";			
		echo"<img class='resource-image' src='img/pic-min/".$newItem['pic-min']."'>";
		echo"	<p>".$newItem['namemin']."</p>";
		echo "</div>";
	}
}
echo "<div class='resource-site flex' id='edit'><img class='edit smooth' src='../img/icon/edit-pencil-outline-in-circular-button.png' style='height: 44px; width: 44px;'></div>";

?>