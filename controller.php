<?php
include 'classes/JSONDb.php';
include 'classes/Parser.php';
$db_path = 'db.json';
$encryption_key = 'Abc1234.';

$JSONDb = new JSONDb($db_path, $encryption_key);
$db = $JSONDb->getDb();	
$parser = new Parser();

//Trim all $_REQUEST
if (isset($_REQUEST) && !empty($_REQUEST)) {
	foreach ($_REQUEST as $k => $v) {
		if (!is_array($v)) {
			$_REQUEST[$k] = trim($v);
		}
	}
}

//Add to DB
if (isset($_REQUEST['uri'])) {	
	if (!isset($db[$_REQUEST['uri']])) {				
		//Add as not bought
		$db[$_REQUEST['uri']] = 0;
		//Save the db
		$JSONDb->saveDb($db);
		//Alert
		$alert_lvl = 'success';		
		$alert = '<b>'.$_REQUEST['uri'].'</b> was added to the DB.';
	} else {
		//Alert
		$alert_lvl = 'warning';
		$alert = '<b>'.$_REQUEST['uri'].'</b> was already in the DB. Nothing was done.';
	}
}
//Remove from DB
elseif (isset($_REQUEST['delete'])) {			
	if (isset($db[$_REQUEST['delete']])) {				
		//Unset the uri from the db
		unset($db[$_REQUEST['delete']]);
		//Save the db
		$JSONDb->saveDb($db);
		//Alert
		$alert_lvl = 'success';		
		$alert = '<b>'.$_REQUEST['delete'].'</b> was deleted.';
	} else {		
		//Alert
		$alert_lvl = 'warning';		
		$alert = '<b>'.$_REQUEST['delete'].'</b> wasn\'t in the DB. Nothing was done.';
	}
}
//Mark as bought
elseif (isset($_REQUEST['mark'])) {
	if (isset($db[$_REQUEST['mark']])) {		
		if (!isset($_REQUEST['val']) || !is_numeric($_REQUEST['val'])) {
			//Mark as bought as default
			$_REQUEST['val'] = 1;
		}		
		if (isset($db[$_REQUEST['mark']])) {
			//Mark the uri
			$db[$_REQUEST['mark']] = $_REQUEST['val'];
			//Save the db
			$JSONDb->saveDb($db);		
		}
		//Alert
		if ($_REQUEST['val'] == 1) {
			$trad = 'bought';
		} else {
			$trad = 'not bought';
		}
		$alert_lvl = 'success';		
		$alert = '<b>'.$_REQUEST['mark'].'</b> was marked as '.$trad.'.';
	} else {
		$alert_lvl = 'warning';		
		$alert = '<b>'.$_REQUEST['mark'].'</b> wasn\'t in the DB. Nothing was done.';
	}
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