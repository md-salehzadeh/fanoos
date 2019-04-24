<?php

namespace App\Http\Helpers\Services\Sms;

class SmsAdapter
{
	private $adapter;

	public function __construct() {
		$driver = config('sms.driver');
		
		switch ( $driver ) {
			case 'faraz':
				$this->adapter = new Adapters\FarazAdapter;
				break;
		}
	}

	public function setNumber($number) {
		$this->adapter->setNumber($number);
		
		return $this;
	}

	public function message($message) {
		$this->adapter->message($message);

		return $this;
	}

	public function setPattern($id, $data) {
		$this->adapter->setPattern($id, $data);

		return $this;
	}

    public function send()
    {
		return $this->adapter->send();
	}
	
}