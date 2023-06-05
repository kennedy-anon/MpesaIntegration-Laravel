<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $CallBackURL = 'https://hkdk.events/9ljemIq1p4nX';
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

        $data = json_decode($stkPushSimulation, true);

        if ($data['ResponseCode'] == 0) {
            return redirect('/payments')->with('message', $data['CustomerMessage']);
        }else {
            return redirect('/payments')->with('message', 'Request not complete.');
        }

    }

    // receiving & processing mpesa receipts
    public function mpesaReceipts(Request $request) {
        Log::info($request);
        dd($request);
    }
}
