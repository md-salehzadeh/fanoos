<?php

namespace App\Http\Helpers\Services\Payment\Adapters;
use GuzzleHttp\Client;

class Payping
{
	private $token = '8af6f2d0e34179ebcbc6de33f2b4bfb3da97b6c30a2a81d6205584259b60bf12';
	private $base_url = 'https://api.payping.ir/v1';

	private $amount;
	private $returnUrl = '';
	private $payerName = '';
	private $payerIdentity = '';
	private $clientRefId = '';
	private $description = '';
	
	private $transId = '';
	private $refId = '';

	public function setAmount($amount) {
		$this->amount = $amount;
	}

	public function setReturnUrl($returnUrl) {
		$this->returnUrl = $returnUrl;
	}

	public function setPayerName($payerName) {
		$this->payerName = $payerName;
	}

	public function setPayerIdentity($payerIdentity) {
		$this->payerIdentity = $payerIdentity;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setClientRefId($clientRefId) {
		$this->clientRefId = $clientRefId;
	}

	public function setRefId($refId) {
		$this->refId = $refId;
	}

    public function create()
    {
		$client = new Client();

		$response = $client->request('POST', $this->base_url.'/pay', [
			'headers' => [
				'authorization' => 'Bearer '.$this->token,
				'content-type' => 'application/json',
				'accept' => 'application/json'
			],
			'json' => [
				"payerName" => $this->payerName,
				"amount" => $this->amount,
				"payerIdentity" => $this->payerIdentity,
				"returnUrl" => $this->returnUrl,
				"description" => $this->description,
				"clientRefId" => $this->clientRefId
			]
		]);

		$body = json_decode($response->getBody(), true);

		$this->transId = $body['code'];
	}

    public function getTransId()
    {
		return $this->transId;
	}

    public function redirect()
    {
		return redirect('https://api.payping.ir/v1/pay/gotoipg/'.$this->transId);
	}

    public function verify()
    {
		try {
			$client = new Client();

			$response = $client->request('POST', $this->base_url.'/pay/verify', [
				'headers' => [
					'authorization' => 'Bearer '.$this->token,
					'content-type' => 'application/json',
					'accept' => 'application/json'
				],
				'json' => [
					"refid" => $this->refId,
					"amount" => $this->amount,
				]
			]);

			$body = json_decode($response->getBody(), true);

			$verified = ( $response->getStatusCode() == 200 ) ? true : false;
		} catch ( \GuzzleHttp\Exception\ClientException $e ) {
			$verified = false;
		}

		return $verified;
	}
	
}