<?php

namespace Shoplemo\Model;

use Shoplemo\JsonSerializableModel;

class Billing extends JsonSerializableModel
{
	private $full_name;
	private $tax_number;
	private $tax_house;
	private $phone;
	private $address;
	private $city;
	private $country;
	private $postalcode;

	function __construct()
	{
	}

	public function getFullname()
	{
		return $this->full_name;
	}

	public function setFullName($full_name)
	{
		$this->full_name = $full_name;
	}

	public function getTaxNumber()
	{
		return $this->tax_number;
	}

	public function setTaxNumber($tax_number)
	{
		$this->tax_number = $tax_number;
	}

	public function getTaxHouse()
	{
		return $this->tax_house;
	}

	public function setTaxHouse($tax_house)
	{
		$this->tax_house = $tax_house;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function setPhone($phone)
	{
		$this->phone = $phone;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function setAddress($address)
	{
		$this->address = $address;
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

	public function getPostalCode()
	{
		return $this->postalcode;
	}

	public function setPostalCode($postalcode)
	{
		$this->postalcode = $postalcode;
	}

	public function jsonSerialize()
	{
		return get_object_vars($this);
	}
}
