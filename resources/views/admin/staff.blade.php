@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All Staff Details</h2>

        @if ($staffCars->isEmpty())
            <p>No staff cars registered yet.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Staff Name</th>
                        <th>Car Plate Number</th>
                        <th>Card Number</th>
                        <!-- Add more columns if necessary -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staffCars as $staffCar)
                        <tr>
                            <td>{{ $staffCar->staff_name }}</td>
                            <td>{{ $staffCar->car_plate_number }}</td>
                            <td>{{ $staffCar->card_number }}</td>
                            <!-- Add more columns if necessary -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
