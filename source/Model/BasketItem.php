<?php

namespace Shoplemo\Model;

use Shoplemo\JsonSerializableModel;

class BasketItem extends JsonSerializableModel
{
	private $category;
	private $name;
	private $type;
	private $price;
	private $quantity;

	const PHYSICAL 	= 0;
	const DIGITAL 	= 1;

	function __construct()
	{
		$this->category = 0;
	}

	public function getCategory()
	{
		return $this->category;
	}

	public function setCategory($category)
	{
		$this->category = $category;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getType()
	{
		return $this->type;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function setPrice($price)
	{
		$this->price = $price;
	}

	public function getQuantity()
	{
		return $this->quantity;
	}

	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;
	}

	public function jsonSerialize()
	{
		return get_object_vars($this);
	}
}
