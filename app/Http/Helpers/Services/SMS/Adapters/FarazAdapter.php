<?php

namespace App\Http\Helpers\Services\Sms\Adapters;

class FarazAdapter
{
	// to be filled with actual informaton from this sms service provider
	private $from = '';
	private $username = '';
	private $password = '';

	private $numbers = [];
	private $message = [];
	private $pattern_id;
	private $pattern_data;

	public function setNumber($number) {
		if ( !in_array($number, $this->numbers) ) $this->numbers[] = $number;
	}

	public function message($message) {
		$this->message = $message;
	}

	public function setPattern($id, $data) {
		$this->pattern_id = $id;
		$this->pattern_data = $data;
	}

	public function makeRequest($url, $param) {
		$handler = curl_init($url);
		curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($handler);
		
		$response = json_decode($response);

		return $response;
	}

    public function send()
    {

		if ( $this->message ) {
			$url = "37.130.202.188/services.jspd";
		
			$param = [
				'uname' => $this->username,
				'pass' => $this->password,
				'from' => $this->from,
				'message' => $this->message,
				'to' => json_encode($this->numbers),
				'op' => 'send'
			];

			$response = $this->makeRequest($url, $param);
			$res_code = $response[0];
			$res_data = $response[1];

			return [
				'status' => $res_code === 0 ? 'success' : 'error',
				'data' => $res_data
			];
		} elseif ( $this->pattern_id && $this->pattern_data ) {
			$url = "http://37.130.202.188/patterns/pattern?username=" . $this->username . "&password=" . urlencode($this->password) . "&from={$this->from}&to=" . json_encode($this->numbers) . "&input_data=" . urlencode(json_encode($this->pattern_data)) . "&pattern_code=".$this->pattern_id;
			
			$param = [];

			$response = $this->makeRequest($url, $param);

			return [
				'status' => 'success',
				'data' => $response
			];
		}

	}
	
}