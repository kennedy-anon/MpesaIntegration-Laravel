<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mpesa;

class PaymentController extends Controller
{
    // showing the mpesa form
    public function mpesaCreate() {
        return view('payments.mpesa');
    }

    // performing payments
    public function stkPush(Request $request) {
        $formFields = $request->validate([
            'phone_no' => ['required', 'numeric'],
            'amount' => ['required', 'numeric']
        ]);
        
        $mpesa= new \Safaricom\Mpesa\Mpesa();
        $BusinessShortCode = 174379;
        $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919' ;
        $TransactionType = 'CustomerPayBillOnline'; 
        $Amount = $formFields['amount'];
        $PartyA = $formFields['phone_no'];
        $PartyB = 174379;
        $PhoneNumber = $formFields['phone_no']; 
        $CallBackURL = 'https://mydomain.com/path';
        $AccountReference = 'Kennedy\'s Investments';
        $TransactionDesc = 'Testing the System';
        $Remarks = 'Remarks';

        $stkPushSimulation=$mpesa->STKPushSimulation(
            $BusinessShortCode, 
            $LipaNaMpesaPasskey, 
            $TransactionType, 
            $Amount, 
            $PartyA, 
            $PartyB, 
            $PhoneNumber, 
            $CallBackURL, 
            $AccountReference, 
            $TransactionDesc, 
            $Remarks);

        dd($stkPushSimulation);
    }
}
