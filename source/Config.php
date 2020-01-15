<?php
namespace Shoplemo;

class Config{
	private $apiKey;
	private $secretKey;
	private $serviceBaseUrl;
	private $SDKVersion = "1.0.0";
	
	public function getSDKVersion(){
		return $this->SDKVersion;
	}

	public function getApiKey(){
		return $this->apiKey;
	}

	public function setApiKey($apiKey){
		$this->apiKey = $apiKey;
	}

	public function getSecretKey(){
		return $this->secretKey;
	}

	public function setSecretKey($secretKey){
		$this->secretKey = $secretKey;
	}

	public function getServiceBaseUrl(){
		return $this->serviceBaseUrl;
	}

	public function setServiceBaseUrl($serviceBaseUrl){
		$this->serviceBaseUrl = $serviceBaseUrl;
	}
}