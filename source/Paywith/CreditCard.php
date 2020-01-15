<?php

namespace Shoplemo\Paywith;

use Shoplemo\Model;
use Shoplemo\Config;
use Shoplemo\Request;

class CreditCard extends Request
{
    const PATH = '/paywith/credit_card';

    private $user_email;
    private $basket_details;
    private $buyer_details;
    private $shipping_details;
    private $billing_details;
    private $custom_params;

    function __construct(Config $config)
    {
        parent::__construct($config, self::PATH);
    }

    public function getUser_email()
    {
        return $this->user_email;
    }

    public function setUser_email($user_email)
    {
        $this->user_email = $user_email;
    }

    public function getBasket()
    {
        return $this->basket_details;
    }

    public function setBasket(Model\Basket $basket_details)
    {
        $this->basket_details = $basket_details;
    }

    public function getBuyer()
    {
        return $this->buyer_details;
    }

    public function setBuyer(Model\Buyer $buyer_details)
    {
        $this->buyer_details = $buyer_details;
    }

    public function getShipping()
    {
        return $this->shipping_details;
    }

    public function setShipping(Model\Shipping $shipping_details)
    {
        $this->shipping_details = $shipping_details;
    }

    public function getBilling()
    {
        return $this->billing_details;
    }

    public function setBilling(Model\Billing $billing_details)
    {
        $this->billing_details = $billing_details;
    }

    public function getCustom_params()
    {
        return $this->custom_params;
    }

    public function setCustom_params($custom_params)
    {
        $this->custom_params = $custom_params;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function execute()
    {
        return parent::post($this->jsonSerialize());
    }

    public function getResponse($object = false)
    {
        return parent::getResponse($object);
    }

    public function getError($object = false)
    {
        return parent::getError($object);
    }
}
