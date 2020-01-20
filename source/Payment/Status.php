<?php

namespace Shoplemo\Payment;

use Shoplemo\Config;
use Shoplemo\Request;

class Status extends Request
{
	const PATH = '/payment/status';

	function __construct(Config $config)
	{
		parent::__construct($config, self::PATH);
	}

	public function execute($progress_id)
	{
		return parent::get($progress_id);
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
