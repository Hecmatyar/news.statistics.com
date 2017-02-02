<?php 
$resourceList = $_POST['allresource'];
echo "<div class='add-new col-lg-2 col-md-3 col-sm-4 col-xs-6'>";
echo "<img class='back-image-new' src='img/14.jpg'/>";
echo "<div class='new-resource smooth flex'><p>ДОБАВИТЬ НОВЫЙ <span>РЕСУРС</span></p><br><img class='smooth' src='img/icon/plus.png'/></div></div>";

foreach ($resourceList as $Item){
	echo "<div class='grid col-lg-2 col-md-3 col-sm-4 col-xs-6'><figure class='effect-sadie'>";
	echo"<img class='back-image' src='img/pic-max/".$Item['pic-max']."'>";
	echo "<figcaption><h3><span>".$Item['namemin']."</span></h3>";
	echo "<p>".$Item['name']."<br><br><img src='../img/icon/edit-white.png'><img src='../img/icon/ok-white.png' ><img src='../img/icon/close-white.png'></p>
</figcaption></figure></div>";	
}
?>