<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JSONDb
 *
 * @author IBERLEY\oaviles
 */
class JSONDb {
	private $path;
	private $encryption_key;
	private $db;
	
	/**
	 * 
	 * @param type $path
	 * @param type $encryption_key
	 */
	function __construct($path,$encryption_key=false) {
		$this->setPath($path);
		$this->setEncryption_key($encryption_key);
		$this->setDb($this->getDbFromFile());
	}
	
	function getDbFromFile() {			
		if (!file_exists($this->getPath())) {
			file_put_contents($this->getPath(),'');
		}		
		$return = json_decode($this->decrypt(file_get_contents($this->getPath())), true);	
		if (!is_array($return)) {
			return [];
		}
		return $return;
	}
	
	function saveDb($db) {					
		file_put_contents($this->getPath(),$this->encrypt(json_encode($db)));
	}
	
	function encrypt($dataHash) {		
		if ($this->getEncryption_key() !== false) {
			$dataHash = @openssl_encrypt($dataHash,"AES-128-ECB",$this->getEncryption_key());	
		}		
		return $dataHash;
    }
	
    function decrypt($dataHash) {
		if ($this->getEncryption_key() !== false) {
	        $dataHash = @openssl_decrypt($dataHash, "AES-128-ECB", $this->getEncryption_key());		
		}
		return $dataHash;
    }
	
	function getPath() {
		return $this->path;
	}

	function setPath($path) {
		$this->path = $path;
	}
	
	function getEncryption_key() {
		return $this->encryption_key;
	}

	function setEncryption_key($encryption_key) {
		$this->encryption_key = $encryption_key;
	}
	
	function getDb() {
		return $this->db;
	}

	function setDb($db) {
		$this->db = $db;
	}	
}
