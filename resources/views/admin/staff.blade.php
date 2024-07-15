@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>All Staff Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-end mb-3">
                            <a class="btn btn-secondary" href="{{ route('admin.staff.cars.register') }}">Register Staff</a>
                        </div>

                        @if ($staffCars->isEmpty())
                            <div class="alert alert-warning text-center">
                                No staff cars registered yet.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Staff Name</th>
                                            <th>Car Plate Number</th>
                                            <th>Card Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($staffCars as $staffCar)
                                            <tr>
                                                <td>{{ $staffCar->staff_name }}</td>
                                                <td>{{ $staffCar->car_plate_number }}</td>
                                                <td>{{ $staffCar->card_number }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
