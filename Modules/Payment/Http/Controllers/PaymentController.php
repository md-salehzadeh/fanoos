<?php

namespace Modules\Payment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Payment\Entities\Transaction;
use Modules\Payment\Entities\Invoice;

class PaymentController extends Controller
{
	
    public function invoiceCreate(Request $request) {
		$amount = intval($request->amount);

		if ( !$amount || $amount < 100 ) {
			return api_response([
				'error' => 'invalid_amount',
				'message' => 'مبلغ صحیح نیست',
			], 400);
		}

		$invoice = Invoice::create([
			'user_id' => \Auth::user()->id,
			'price' => $amount,
			'description' => '',
			'type' => 'wallet_deposit',
			'invoice_status' => 'inserted',
		]);

		$invoice_id = $invoice->id;
		
		$invoice = Invoice::with('Transaction')->where('id', $invoice_id)->first()->main_cols();
		return api_response([
			'invoice' => $invoice,
			'pay_url' => url("transaction/pay/$invoice_id"),
		], 200);
	}
	
    public function pay($invoice_id) {
		$invoice = Invoice::where('id', $invoice_id)->first();

		if ( !$invoice ) {
			\Hook::action('Payment::pay|invoice_not_found', compact('invoice'));
			
			$viewPath = resource_path('views/modules/payment/Resources/views');

			$pay_title = 'پرداخت امکان پذیر نیست';
			$pay_message = 'صورتحساب پرداخت صحیح نمی باشد.';
			$pay_status = 'failed';
			return view('payment::payment-status', compact('pay_message', 'pay_status', 'pay_title'));
		}

		if ( $invoice->invoice_status == 'paid' ) {
			\Hook::action('Payment::pay|invoice_already_paid', compact('invoice'));

			$pay_title = 'پرداخت امکان پذیر نیست';
			$pay_message = 'این صورتحساب قبلا توسط شما یا شخص دیگری پرداخت شده است.';
			$pay_status = 'failed';
			return view('payment::payment-status', compact('pay_message', 'pay_status', 'pay_title'));
		}

		$transaction = Transaction::create([
			'invoice_id' => $invoice_id,
			'trans_status' => 'failed',
			'type' => 'online',
			'adapter' => config('payment.driver'),
		]);
		$transaction_id = $transaction->id;

		\Hook::action('Payment::pay|transaction_created', compact('invoice', 'transaction'));

		$payment = new \Payment;

		$payment
			->setAmount($invoice->price)
			->setReturnUrl(url('transaction/pay-callback'))
			->setClientRefId($transaction_id)
			->create();

		$trans_id = $payment->getTransId();
		
		\Hook::action('Payment::pay|payment_created', compact('invoice', 'transaction', 'payment', 'trans_id'));

		return $payment->redirect();
	}
	
    public function payCallback(Request $request) {
		$refId = $request->refid;
		$ClientRefId = $request->clientrefid;

		$transaction = Transaction::where('id', $ClientRefId)->first();

		if ( $transaction->trans_status == 'paid' ) {
			$pay_title = 'پرداخت موفق';
			$pay_message = 'پرداخت با موفقیت انجام شده است هم اکنون میتوانید برای ادامه مراحل به برنامه بازگردید.';
			$pay_status = 'success';
			return view('payment::payment-status', compact('pay_message', 'pay_status', 'pay_title'));
		}
		
		$transaction->trace_number = $refId;
		$transaction->save();

		$invoice = $transaction->Invoice()->first();

		if ( !$invoice ) {
			$pay_title = 'پرداخت امکان پذیر نیست';
			$pay_message = 'صورتحساب پرداخت صحیح نبوده و مبلغ پرداختی به حساب شما باز گردانده خواهد شد.';
			$pay_status = 'failed';
			return view('payment::payment-status', compact('pay_message', 'pay_status', 'pay_title'));
		}
		
		$payment = new \Payment;

		$verified = $payment
			->setRefId($refId)
			->setAmount($invoice->price)
			->verify();

		$transaction->update([
			'trans_status' => $verified ? 'paid' : 'failed'
		]);

		$invoice->update([
			'invoice_status' => $verified ? 'paid' : 'failed'
		]);

		if ( $verified ) {
			$pay_title = 'پرداخت موفق';
			$pay_message = 'پرداخت با موفقیت انجام شده است هم اکنون میتوانید برای ادامه مراحل به برنامه بازگردید.';
			$pay_status = 'success';
		} else {
			$pay_title = 'پرداخت ناموفق';
			$pay_message = 'پرداخت موفقیت آمیز نبود است.';
			$pay_status = 'failed';
		}
		return view('payment::payment-status', compact('pay_message', 'pay_status', 'pay_title'));
	}

}
