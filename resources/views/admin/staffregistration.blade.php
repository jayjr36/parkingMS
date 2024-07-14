@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Register Staff Car</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.staff.cars.register') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="staff_name">Staff Name</label>
                <input type="text" id="staff_name" name="staff_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="car_plate_number">Car Plate Number</label>
                <input type="text" id="car_plate_number" name="car_plate_number" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="card_number">Card Number</label>
                <input type="text" id="card_number" name="card_number" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection
