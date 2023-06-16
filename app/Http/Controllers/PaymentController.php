<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Database\QueryException;
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
        $CallBackURL = 'https://hkdk.events/TZzoh87e24ks';
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
        Log::info($data);

        if ($data['ResponseCode'] == 0) {
            return redirect('/payments/fetch')->with('message', $data['CustomerMessage']);
        }else {
            return redirect('/payments')->with('message', 'Request not complete.');
        }

    }

    // receiving & processing mpesa receipts
    public function mpesaReceipts(Request $request) {
        // $receipt = json_decode($request, true);  // uncomment this
        $receipt = $request; // comment this
        $metadata = array(
            'MerchantRequestID' => $receipt['Body']['stkCallback']['MerchantRequestID'],
            'CheckoutRequestID' => $receipt['Body']['stkCallback']['CheckoutRequestID'],
            'ResultCode' => $receipt['Body']['stkCallback']['ResultCode'],
            'ResultDesc' => $receipt['Body']['stkCallback']['ResultDesc'],
        );

        if ($metadata['ResultCode'] == 0) {
            // successful payment
            $item = $receipt['Body']['stkCallback']['CallbackMetadata']['Item'];
            $mpesaData = array_column($item, 'Value', 'Name');

            $dbFields = [
                'sender' => $mpesaData['PhoneNumber'],
                'amount' => $mpesaData['Amount'],
                'date' => $mpesaData['TransactionDate'],
                'receipt_number' => $mpesaData['MpesaReceiptNumber']
            ];

            Log::info($dbFields);
            try{
                // save to database
                Payment::create($dbFields);
            } catch (QueryException $e) {
                $errorCode = $e->getCode();

                if ($errorCode == '23000'){
                    Log::error('Duplicate entry for receipt number: ' . $dbFields['receipt_number']);
                } else {
                    Log::error('Query Exception: ' . $e->getMessage());
                }
            }
            
        }else{
            // payment did not go through, handle the error message
            Log::info($metadata['ResultDesc']);
        }

        // if error message is handled, modify the return statement
        return redirect('/payments')->with('message', 'Payment received');
    }

    // fetch payments made
    public function fetchPayments() {
        return view('payments.payed', [
            'payments' => Payment::latest()->get()
        ]);
    }
}
