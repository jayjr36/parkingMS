
@extends('layouts.app') 

@section('content')
    <div class="container">
        <h1>Stored Plate Numbers</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Plate Number</th>
                    <th>Card Number</th>
                    <th>Image</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plates as $plate)
                <tr>
                    <td>{{ $plate->id }}</td>
                    <td>{{ $plate->plate_number }}</td>
                    <td>{{ $plate->card_no }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $plate->image_path) }}" alt="Plate Image" width="100">
                    </td>
                    <td>{{ $plate->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('parking.payment.form') }}">PAYMENT</a>
    </div>
@endsection
