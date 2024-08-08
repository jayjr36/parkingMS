<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\StaffCar;
use App\Models\NumberPlate;
use App\Models\ParkingSlot;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use App\Models\ParkingPayment;
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
            'card_number' => 'required|string',
            'expiry_date' => 'required|date_format:m/y',
            'amount' => 'required|numeric',
            'cvc' => 'required|numeric|max:999',
        ]);
    
        $paymentDetail = PaymentDetail::where('card_number', $request->card_number)
                                        ->latest()
                                        ->first();
        
        if ($paymentDetail) {
            $parkingPayment = ParkingPayment::where('card_number', $request->card_number)
                                            ->latest()
                                            ->first();
    
            if ($parkingPayment && $parkingPayment->payment_fee == $request->amount) {
                $parkingPayment->status = 'paid';
                $parkingPayment->save();
    
                $parkingSlot = ParkingSlot::where('slot_number', $paymentDetail->parking_slot)
                                          ->first();
    
                if ($parkingSlot) {
                    $parkingSlot->status = 'available';
                    $parkingSlot->save();
                }

                return redirect()->route('parking.payment.form')->with('success', 'Payment processed successfully. You have 10 minutes to exit the parking before the payment expires.');
    
                // return response()->json(['message' => 'Payment processed successfully. You have 10 minutes to exit the parking before the payment expires.'], 200);
            } else {
                return redirect()->back()->withErrors('Entered amount does not match the parking fee.');
                // return response()->json(['message' => 'Entered amount does not match the parking fee.'], 400);
            }
        } else {
            // return response()->json(['message' => 'Payment detail not found.'], 404);
            return redirect()->back()->withErrors('Parking detail not found.');
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
    
        $isStaff = StaffCar::where('card_number', $request->card_number)->exists();
    
        if ($isStaff) {
            return response()->json(['success' => true, 'message' => 'Parking is free for staff members'], 200);
        }
    
        $payment = ParkingPayment::where('card_number', $request->card_number)->where('status', 'paid')->first();
    
        if ($payment) {
            return response()->json(['success' => true, 'payment' => $payment], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Payment not found or not completed'], 404);
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
            $slot = $paymentDetail->parking_slot;
            $currentTime = Carbon::now();
            $durationInMinutes = $currentTime->diffInMinutes($timeIn);
        
            if ($durationInMinutes <= 5) {
                $paymentFee = 500;
            } elseif ($durationInMinutes <= 30) {
                $paymentFee = 1000;
            } elseif ($durationInMinutes <= 60) {
                $paymentFee = 2000;
            } elseif ($durationInMinutes <= 120) {
                $paymentFee = 4000;
            } elseif ($durationInMinutes <= 300) {
                $paymentFee = 6500;
            } else {
                $paymentFee = 6500 + ceil(($durationInMinutes - 300) / 60) * 1000; 
            }
        
            $result = [
                'car_plate_number' => $paymentDetail->car_plate_number,
                'time_in' => $timeIn,
                'payment_fee' => $paymentFee,
                'time_out' => $currentTime,
                'time_spent' => $durationInMinutes,
                'slot' => $slot
            ];

            ParkingPayment::create([
                'card_number' => $request->card_number,
                'payment_fee' => $paymentFee,
                'time_spent' =>$durationInMinutes
            ]);
        }
        

        return view('search', [
            'result' => $result,
            'error_message' => !$paymentDetail ? 'No record found for this plate number.' : null,
        ]);
    }

    public function showParkingSlots()
{
    $parkingSlots = ParkingSlot::all();
    return view('parking', compact('parkingSlots'));
}
}