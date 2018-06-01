<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Parser
 *
 * @author IBERLEY\oaviles
 */
class Parser {
	private $uri;
	private $html;
	
	function __construct($uri=false) {
		$this->setUri($uri);		
	}		
	
	function extract() {			
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->getUri());
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		$data = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$error = curl_error($ch);
		curl_close($ch);
		$response = ($httpcode>=200 && $httpcode<300) ? $data : false;		
		return $response;			
	}
	
	function getUri() {
		return $this->uri;
	}

	function getHtml() {
		return $this->html;
	}

	function setUri($uri) {
		$this->uri = $uri;
		if ($uri) {
			$this->setHtml($this->extract());
		}
	}

	function setHtml($html) {
		$this->html = $html;
	}


}
