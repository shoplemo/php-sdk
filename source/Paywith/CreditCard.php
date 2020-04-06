<?php

namespace Shoplemo\Paywith;

use Shoplemo\Config;
use Shoplemo\Model;
use Shoplemo\Request;

class CreditCard extends Request
{
    const PATH = '/paywith/credit_card';

    private $language;
    private $user_email;
    private $basket_details;
    private $buyer_details;
    private $shipping_details;
    private $billing_details;
    private $custom_params;
    private $redirect_url;
    private $fail_redirect_url;
    private $callback_url;

    public function __construct(Config $config)
    {
        parent::__construct($config, self::PATH);
        $this->buyer_details = new Model\Buyer();
        $this->language = 'tr';
        $this->redirect_url = '';
        $this->fail_redirect_url = '';
        $this->callback_url = '';
    }

    public function getUserEmail()
    {
        return $this->user_email;
    }

    public function setUserEmail($user_email)
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

    public function getCustomParams()
    {
        return $this->custom_params;
    }

    public function setCustomParams($custom_params)
    {
        $this->custom_params = $custom_params;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getRedirectUrl()
    {
        return $this->redirect_url;
    }

    public function setRedirectUrl($redirect_url)
    {
        $this->redirect_url = $redirect_url;
    }

    public function getFailRedirectUrl()
    {
        return $this->fail_redirect_url;
    }

    public function setFailRedirectUrl($fail_redirect_url)
    {
        $this->fail_redirect_url = $fail_redirect_url;
    }

    public function getCallbackUrl()
    {
        return $this->callback_url;
    }

    public function setCallbackUrl($callback_url)
    {
        $this->callback_url = $callback_url;
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
