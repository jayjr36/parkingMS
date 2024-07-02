<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Plate Number</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                <label for="car_plate_number">Car Plate Number</label>
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
                <label for="payment_fee">Parking Fee:</label>
                <input type="text" class="form-control" id="payment_fee" value="{{ $result['payment_fee'] }}" readonly>
            </div>
            <div class="form-group">
                <a href="{{route('parking.payment.form')}}" class="text-center btn btn-secondary">GO TO PAYMENT PAGE</a>
            </div>
        @endisset

        @if(session('error_message'))
            <div class="alert alert-danger">{{ $error_message }}</div>
        @endif
    </div>
    <div class="row text-center">
   
     </div>
</body>
</html>
