<?php 
class Graph
{	
	function __construct()
	{
		# code...
	}
	public static function getAllDictioanary(){
		$db = Db::getConnection();			
		$newsList = array();
		$query = 'SELECT  d.id,  d.name, d.words, d.border, d.attitude, v.name as viewname
			FROM dictionary d
			JOIN viewfield v ON d.idfield = v.id
			ORDER BY v.id, d.id';
		$result = $db->query($query);
		$result->setFetchMode(PDO::FETCH_ASSOC);  
		while ($row = $result->fetch()){
			$newsList[$row['viewname']][$row['id']]['name'] = $row['name'];
			$newsList[$row['viewname']][$row['id']]['words'] = $row['words'];
			$newsList[$row['viewname']][$row['id']]['border'] = $row['border'];
			$newsList[$row['viewname']][$row['id']]['attitude'] = $row['attitude'];
			$newsList[$row['viewname']][$row['id']]['id'] = $row['id'];
		}	
		return json_encode($newsList);
	}
	
	//return an array of news item
	public static function getUsesResource($where){
		//подключение к базе данных
		$db = Db::getConnection();			
		$newsList = array();		
		$result = $db->query('SELECT * FROM resource '.$where);
		$result->setFetchMode(PDO::FETCH_ASSOC);  
		while ($row = $result->fetch()){
			$newsList[$row['id']]['id'] = $row['id'];
			$newsList[$row['id']]['name'] = $row['name'];
			$newsList[$row['id']]['namemin'] = $row['namemin'];
			$newsList[$row['id']]['address'] = $row['address'];
			$newsList[$row['id']]['pic-min'] = $row['pic-min'];		
			$newsList[$row['id']]['pic-max'] = $row['pic-max'];		
			$newsList[$row['id']]['effect'] = $row['effect'];				
		}	
		return $newsList;		
	}
	public static function getAllResource(){
		//подключение к базе данных
		$db = Db::getConnection();			
		$newsList = array();		
		$result = $db->query('SELECT * FROM resource');
		$result->setFetchMode(PDO::FETCH_ASSOC);  
		while ($row = $result->fetch()){
			$newsList[$row['id']]['id'] = $row['id'];
			$newsList[$row['id']]['name'] = $row['name'];
			$newsList[$row['id']]['namemin'] = $row['namemin'];
			$newsList[$row['id']]['address'] = $row['address'];
			$newsList[$row['id']]['pic-min'] = $row['pic-min'];		
			$newsList[$row['id']]['pic-max'] = $row['pic-max'];
			$newsList[$row['id']]['effect'] = $row['effect'];				
		}	
		return json_encode($newsList);		
	}

	public static function getMainGraph($numres){
		//выбор временного промежутка
		$addittimes = '';
		if($numres == 1)
			$addittimes = 'polldate > NOW() - INTERVAL 7 DAY';
		else if($numres == 2)
			$addittimes = 'polldate > NOW() - INTERVAL 30 DAY';
		else if($numres == 3)
			$addittimes = 'MONTH(`polldate`) = MONTH(NOW()) AND YEAR(`polldate`) = YEAR(NOW())';
		else if($numres == 4)
			$addittimes = 
		'(MONTH(`polldate`) = MONTH(DATE_ADD(NOW(), INTERVAL -1 MONTH)) AND YEAR(`polldate`) = YEAR(NOW())) or (MONTH(`polldate`) = MONTH(DATE_ADD(NOW(), INTERVAL -1 MONTH)) AND YEAR(`polldate`) = YEAR(DATE_ADD(NOW(), INTERVAL -1 YEAR)))';
		else if($numres == 5)
			$addittimes = 'polldate > NOW() - INTERVAL 6 MONTH';
		else if($numres == 6)
			$addittimes = '1 = 1';

		//подключение к базе данных
		$db = Db::getConnection();			
		$ratingGraph = array();			
		
		$query = 'SELECT  n.idresource,  n.iddictionary, r.namemin, n.polldate, n.rating 
			FROM news n
			JOIN resource r ON r.id = n.idresource
			WHERE '.$addittimes.'	ORDER BY namemin, polldate';
		$result = $db->query($query);
		$result->setFetchMode(PDO::FETCH_ASSOC);  
		$i=1;		
		while ($row = $result->fetch()){	
			$iddic = $row['iddictionary'];
			$date=$row['polldate'];
			$y = date('Y',strtotime($date));
			$m = date('m',strtotime($date));
			$d = date('d',strtotime($date));
			$ratingGraph[$iddic][$row['namemin']][$i]['year'] = $y;		
			$ratingGraph[$iddic][$row['namemin']][$i]['month'] = $m;	
			$ratingGraph[$iddic][$row['namemin']][$i]['day'] = $d;		
			$ratingGraph[$iddic][$row['namemin']][$i]['rating'] = floatval($row['rating']);				
			$i++;				
		}
		return json_encode($ratingGraph);
	}
}
?>