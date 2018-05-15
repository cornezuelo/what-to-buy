<?php
include 'classes/JSONDb.php';
$db_path = 'db.json';
$encryption_key = 'Abc1234.';
$JSONDb = new JSONDb($db_path, $encryption_key);
$db = $JSONDb->getDb();	

//Add to db
if (isset($_REQUEST['uri'])) {	
	if (!isset($db[$_REQUEST['uri']])) {		
		$db[$_REQUEST['uri']] = 0;
	}	
	$JSONDb->saveDb($db);
}
//Mark as bought
elseif (isset($_REQUEST['mark'])) {
	if (!isset($_REQUEST['val']) || !is_numeric($_REQUEST['val'])) {
		$_REQUEST['val'] = 1;
	}		
	if (isset($db[$_REQUEST['mark']])) {
		$db[$_REQUEST['mark']] = $_REQUEST['val'];
		$JSONDb->saveDb($db);
	}
}

function get_random($db) {
	$ar_not_bought = [];
	foreach ($db as $uri => $bought) {
		if ($bought == 0) {
			$ar_not_bought[] = $uri;
		}
	}	
	if (empty($ar_not_bought)) return '';
	return $ar_not_bought[rand(0,(count($ar_not_bought)-1))];
}

function parse($uri) {
	//Bandcamp
	/*if (strpos($uri,'bandcamp.com') !== false) {
		
	}*/
	
	return '';
}
