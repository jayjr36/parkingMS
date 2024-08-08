@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>All Payment Details</h3>

        @if ($payments->isEmpty())
            <p>No payments recorded yet.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Card Number</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $payment->card_number }}</td>
                            {{-- <td>{{ $payment->card_number }}</td>
                            <td>{{ $payment->expiry_date }}</td>
                            <td>{{ $payment->cvc }}</td> --}}
                            <td>{{ $payment->payment_fee }}</td>
                            <td>{{ $payment->status }}</td>
                            <td>{{ $payment->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
