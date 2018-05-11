<?php
$db_path = 'db.json';
$db = get_db();	

//Add to db
if (isset($_REQUEST['uri'])) {	
	if (!isset($db[$_REQUEST['uri']])) {		
		$db[$_REQUEST['uri']] = 0;
	}	
	save_db($db);
}
//Mark as bought
elseif (isset($_REQUEST['mark'])) {
	if (!isset($_REQUEST['val']) || !is_numeric($_REQUEST['val'])) {
		$_REQUEST['val'] = 1;
	}		
	if (isset($db[$_REQUEST['mark']])) {
		$db[$_REQUEST['mark']] = $_REQUEST['val'];
		save_db($db);
	}
}


function get_db() {
	global $db_path;
	if (!file_exists($db_path)) {
		file_put_contents($db_path,'');
	}
	$return = json_decode(file_get_contents($db_path),true);	
	if (!is_array($return)) {
		return [];
	}
	return $return;
}

function save_db($db) {
	global $db_path;
	file_put_contents($db_path,json_encode($db));
}

function get_random($db) {
	$ar_not_bought = [];
	foreach ($db as $uri => $bought) {
		if ($bought == 0) {
			$ar_not_bought[] = $uri;
		}
	}	
	return $ar_not_bought[rand(0,(count($ar_not_bought)-1))];
}

function parse($uri) {
	//Bandcamp
	/*if (strpos($uri,'bandcamp.com') !== false) {
		
	}*/
	
	return '';
}