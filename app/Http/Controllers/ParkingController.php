<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkingPayment;
use App\Models\PaymentDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ParkingController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment');
    }
    public function processPayment(Request $request)
    {
        $request->validate([
            'car_plate_number' => 'required|string|max:10',
            'card_number' => 'required|string|max:16',
            'expiry_date' => 'required',
            'cvc' => 'required|numeric|max:999',
        ]);
    
        $paymentDetails = [
            'user_id' => Auth::id(),
            'car_plate_number' => $request->car_plate_number,
            'card_number' => $request->card_number,
            'expiry_date' => $request->expiry_date,
            'cvc' => $request->cvc,
            'amount' => 1000,
            'status' => 'success',
        ];
    
        try {
            ParkingPayment::create($paymentDetails);
            return back()->with('success_message', 'Payment Successful!');
        } catch (\Exception $e) {
            return back()->with('error_message', 'Payment Failed: ' . $e->getMessage());
        }
    }

    public function apiStorePaymentDetails(Request $request)
    {
        $request->validate([
            'car_plate_number' => 'required|string',
            'card_number' => 'required|string',
        ]);

        $paymentDetails = [
            'car_plate_number' => $request->car_plate_number,
            'card_number' => $request->card_number,
        ];

        try {
            ParkingPayment::create($paymentDetails);
            return response()->json(['message' => 'Success'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed' . $e->getMessage()], 500);
        }
    }

    public function apiCheckPayment(Request $request)
    {
        $request->validate([
            'card_number' => 'required|string',
        ]);

        $payment = PaymentDetail::where('card_number', $request->card_number)->first();

        if ($payment) {
            return response()->json(['message' => 'Paid', 'payment' => $payment], 200);
        } else {
            return response()->json(['message' => 'Not Paid'], 404);
        }
    }
    
    public function showSearchForm()
    {
        return view('search');
    }
    public function searchPlateNumber(Request $request)
    {
        $request->validate([
            'card_number' => 'required|string',
        ]);

        $paymentDetail = PaymentDetail::where('card_number', $request->card_number)->first();
        $result = null;

        if ($paymentDetail) {
            $timeIn = $paymentDetail->created_at;
            $currentTime = Carbon::now();
            $duration = $currentTime->diffInHours($timeIn) + ($currentTime->diffInMinutes($timeIn) % 60 > 0 ? 1 : 0);
            $paymentFee = $duration * 1000;

            $result = [
                'car_plate_number' => $paymentDetail->car_plate_number,
                'time_in' => $timeIn,
                'payment_fee' => $paymentFee,
            ];
        }

        return view('search', [
            'result' => $result,
            'error_message' => !$paymentDetail ? 'No record found for this plate number.' : null,
        ]);
    }
}