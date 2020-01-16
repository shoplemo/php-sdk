<?php

namespace Shoplemo\Model;

use Shoplemo\Utilities\Helper;
use Shoplemo\JsonSerializableModel;

class Buyer extends JsonSerializableModel
{
	private $identity_number;
	private $name;
	private $surname;
	private $gsm;
	private $city;
	private $country;
	private $ip;
	private $port;

	function __construct()
	{
		$this->ip = Helper::getIPAddress();
		$this->port = Helper::getPort();
	}

	public function getIdentityNumber()
	{
		return $this->identity_number;
	}

	public function setIdentityNumber($identity_number)
	{
		$this->identity_number = $identity_number;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getSurname()
	{
		return $this->surname;
	}

	public function setSurname($surname)
	{
		$this->surname = $surname;
	}

	public function getGsm()
	{
		return $this->gsm;
	}

	public function setGsm($gsm)
	{
		$this->gsm = $gsm;
	}

	public function getCity()
	{
		return $this->city;
	}

	public function setCity($city)
	{
		$this->city = $city;
	}

	public function getCountry()
	{
		return $this->country;
	}

	public function setCountry($country)
	{
		$this->country = $country;
	}

	public function getIp()
	{
		return $this->ip;
	}

	public function setIp($ip)
	{
		$this->ip = $ip;
	}

	public function getPort()
	{
		return $this->port;
	}

	public function setPort($port)
	{
		$this->port = $port;
	}

	public function jsonSerialize()
	{
		return get_object_vars($this);
	}
}
