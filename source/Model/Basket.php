<?php

namespace Shoplemo\Model;

use Shoplemo\JsonSerializableModel;

class Basket extends JsonSerializableModel
{

	private $items;
	private $currency;
	private $total_price;
	private $coupon_price;

	function __construct()
	{
		$this->currency = 'TRY'; // default;
		$this->coupon_price = 0; // default;
	}

	public function getItems()
	{
		return $this->items;
	}

	public function addItem(BasketItem $item)
	{
		$this->items[] = $item;
	}

	public function getCurrency()
	{
		return $this->currency;
	}

	public function setCurrency($currency)
	{
		$this->currency = $currency;
	}

	public function getTotalPrice()
	{
		return $this->total_price;
	}

	public function setTotalPrice($total_price)
	{
		$this->total_price = $total_price;
	}

	public function getCouponPrice()
	{
		return $this->coupon_price;
	}

	public function setCouponPrice($coupon_price)
	{
		$this->coupon_price = $coupon_price;
	}

	public function jsonSerialize()
	{
		return get_object_vars($this);
	}
}
