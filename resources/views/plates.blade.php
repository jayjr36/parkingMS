{{-- <!-- resources/views/plates/index.blade.php -->

@extends('layouts.app') <!-- Assuming you have a master layout -->

@section('content')
    <div class="container">
        <h1>Stored Plate Numbers</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Plate Number</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plates as $plate)
                <tr>
                    <td>{{ $plate->id }}</td>
                    <td>{{ $plate->plate_number }}</td>
                    <td>{{ $plate->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{route('parking.payment.form')}}">PAYMENT</a>
    </div>
@endsection --}}
