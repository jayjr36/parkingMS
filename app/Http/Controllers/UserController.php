<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentDetail;

class UserController extends Controller
{
    public function paymentHistory()
    {
        $user = Auth::user();
        $payments = PaymentDetail::where('user_id', $user->id)->orderByDesc('created_at')->get();

        return view('payment_history', [
            'payments' => $payments,
        ]);
    }
}
