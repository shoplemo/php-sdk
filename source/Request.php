<?php

namespace Shoplemo;

use Exception;

class Request extends JsonSerializableModel
{
	private $config;
	private $path;

	public $http_code;
	public $response;
	public $error;

	function __construct(Config $config, $path)
	{
		$this->config = $config;
		$this->path = $path;
	}

	private function getBasicAuth()
	{
		return base64_encode($this->config->getApiKey() . ':' . $this->config->getSecretKey());
	}

	public function post($body)
	{
		try {
			$curl = curl_init();

			$data = json_encode($body);

			$header = ["content-type: application/json", "content-lenght: " . strlen($data)];
			$header[] = "Authorization: Basic " . $this->getBasicAuth();
			$header[] = "SDK-Version: " . $this->config->getSDKVersion();

			curl_setopt($curl, CURLOPT_URL, $this->config->getServiceBaseUrl() . $this->path);
			curl_setopt($curl, CURLOPT_ENCODING, "");
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

			$curlResponse = curl_exec($curl);
			$curlInfo = curl_getinfo($curl);

			if ($curlResponse === false) {
				$this->error =  curl_error($curl);
				return false;
			}

			$this->http_code = $curlInfo["http_code"];

			if ($this->http_code == "200") {
				$this->response = $curlResponse;
				return true;
			}

			$this->error = $curlResponse;

			curl_close($curl);

			return false;
		} catch (Exception $ex) {
			throw new Exception("Request Class->" . $ex->getMessage());
		}
	}

	public function get($query)
	{
		try {
			$curl = curl_init();

			$header = ["Authorization: Basic " . $this->getBasicAuth()];
			$header[] = "SDK-Version: " . $this->config->getSDKVersion();

			curl_setopt($curl, CURLOPT_URL, $this->config->getServiceBaseUrl() . $this->path . '/' . $query);
			curl_setopt($curl, CURLOPT_ENCODING, "");
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

			$curlResponse = curl_exec($curl);
			$curlInfo = curl_getinfo($curl);

			if ($curlResponse === false) {
				$this->error =  curl_error($curl);
				return false;
			}

			$this->http_code = $curlInfo["http_code"];

			if ($this->http_code == "200") {
				$this->response = $curlResponse;
				return true;
			}

			$this->error = $curlResponse;

			curl_close($curl);

			return false;
		} catch (Exception $ex) {
			throw new Exception("Request Class->" . $ex->getMessage());
		}
	}

	public function getResponse($object = false)
	{
		if ($object) {
			try {
				return json_decode($this->response);
			} catch (Exception $ex) {
				new Exception($ex->getMessage());
			}
		} else
			return $this->response;
	}

	public function getError($object = false)
	{
		if ($object) {
			try {
				return json_decode($this->error);
			} catch (Exception $ex) {
				new Exception($ex->getMessage());
			}
		} else
			return $this->error;
	}
}
