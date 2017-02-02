<?php 

include_once ROOT.'/views/graph.php';

class Control
{	
	function __construct()
	{
		
	}

	public function action(){		
		require_once(ROOT.'/views/mainpage.php');
		return true;
	}

	// public function actionView($id){
	// 	if($id){
	// 		$newItem = News::getNewsItemById($id);
	// 		echo "<pre>";
	// 		print_r($newItem);
	// 		echo "<pre>";			
	// 	}
	// 	return true;
	// }
} 

?>