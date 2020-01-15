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
	private $postal_code;

	function __construct()
	{
	}
	
	public function getFull_name()
	{
		return $this->full_name;
	}

	public function setFull_name($full_name)
	{
		$this->full_name = $full_name;
	}

	public function getTax_number(){
		return $this->tax_number;
	}

	public function setTax_number($tax_number){
		$this->tax_number = $tax_number;
	}

	public function getTax_house(){
		return $this->tax_house;
	}

	public function setTax_house($tax_house){
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

	public function getPostal_code()
	{
		return $this->postal_code;
	}

	public function setPostal_code($postal_code)
	{
		$this->postal_code = $postal_code;
	}

	public function jsonSerialize()
	{
		return get_object_vars($this);
	}
}
