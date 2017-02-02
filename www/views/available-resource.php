<?php 
$newlist = $_POST['allresource'];
foreach ($newlist as $newItem){
	echo "<div class='choose-site' id='".$newItem['namemin']."'>\n";
	echo"<img class='resource-image' src='img/pic-min/".$newItem['pic-min']."'>";
	echo"	<p>".$newItem['namemin']."</p>";
	echo "</div>";
}

?>