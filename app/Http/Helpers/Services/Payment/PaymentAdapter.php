<?php

namespace App\Http\Helpers\Services\Payment;

class PaymentAdapter
{
	private $adapter;

	public function __construct() {
		$driver = config('payment.driver');
		
		switch ( $driver ) {
			case 'payping':
				$this->adapter = new Adapters\Payping;
				break;
		}
	}

    public function setAmount($amount)
    {
		$this->adapter->setAmount($amount);
		return $this;
	}

    public function setReturnUrl($returnUrl)
    {
		$this->adapter->setReturnUrl($returnUrl);
		return $this;
	}

    public function setPayerName($payerName)
    {
		$this->adapter->setPayerName($payerName);
		return $this;
	}

    public function setPayerIdentity($payerIdentity)
    {
		$this->adapter->setPayerIdentity($payerIdentity);
		return $this;
	}

    public function setDescription($description)
    {
		$this->adapter->setDescription($description);
		return $this;
	}

    public function setClientRefId($clientRefId)
    {
		$this->adapter->setClientRefId($clientRefId);
		return $this;
	}

    public function setRefId($refId)
    {
		$this->adapter->setRefId($refId);
		return $this;
	}

    public function create()
    {
		$this->adapter->create();
		return $this;
	}

    public function getTransId()
    {
		return $this->adapter->getTransId();
	}

    public function redirect()
    {
		return $this->adapter->redirect();
	}

    public function verify()
    {
		return $this->adapter->verify();
	}
	
}