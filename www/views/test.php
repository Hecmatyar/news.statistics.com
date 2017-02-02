<?php 
$ch = curl_init();
$url = "http://oslik.egerev.me:9000/:json:md/habrahabr.ru/rss/interesting/";
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
// curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_HEADER, 0);
// curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10000);
// curl_setopt ($ch, CURLOPT_TIMEOUT, 10000);
$content = curl_exec($ch);
curl_close($ch);
echo $content;
// if(($content = curl_exec($ch)) !== false) {
// 	echo $content;
// 	// $obj=json_decode($content);
// 	foreach ($content as $item){
// 		echo $item;
// 		echo('  -------------х--------------');
// 	}	
// 	curl_close($ch);
// } else {
//   // ошибка
// 	echo 'ошибка';
// 	curl_close($ch);
// }
?>