<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Plate Number</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 30px;
            color: #333;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #ff6600;
            border-color: #ff6600;
        }
        .btn-secondary {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container col-7">
        <h2>Search Plate Number</h2>

        @if(session('error_message'))
            <div class="alert alert-danger">{{ session('error_message') }}</div>
        @endif

        <form action="{{ route('parking.search') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="car_plate_number">RFID Card Number</label>
                <input type="text" class="form-control" id="car_plate_number" name="card_number" required>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        @isset($result)
            <h3>Search Result</h3>

            <div class="form-group">
                <label for="car_plate_number_result">Car Plate Number:</label>
                <input type="text" class="form-control" id="car_plate_number_result" value="{{ $result['car_plate_number'] }}" readonly>
            </div>

            <div class="form-group">
                <label for="time_in">Time In:</label>
                <input type="text" class="form-control" id="time_in" value="{{ $result['time_in'] }}" readonly>
            </div>

            <div class="form-group">
                <label for="time_out">Time Out:</label>
                <input type="text" class="form-control" id="time_out" value="{{ $result['time_out'] }}" readonly>
            </div>

            <div class="form-group">
                <label for="time_spent">Time Spent:</label>
                <input type="text" class="form-control" id="time_spent" value="{{ $result['time_spent'] }} mins" readonly>
            </div>

            <div class="form-group">
                <label for="slot">Parking Slot:</label>
                <input type="text" class="form-control" id="slot" value="{{ $result['slot'] }}" readonly>
            </div>

            <div class="form-group">
                <label for="payment_fee">Parking Fee:</label>
                <input type="text" class="form-control" id="payment_fee" value="{{ $result['payment_fee'] }}" readonly>
            </div>
            <div class="form-group text-center">
                <a href="{{route('parking.payment.form')}}" class="btn btn-success">Go to Payment Page</a>
            </div>
        @endisset

        @if(session('error_message'))
            <div class="alert alert-danger">{{ session('error_message') }}</div>
        @endif
    </div>
    {{-- <div class="row text-center mt-5">
        <div class="col-12">
            <img src="https://example.com/parking_lot_image.jpg" alt="Parking Lot" class="img-fluid">
        </div>
    </div> --}}
</body>
</html>
