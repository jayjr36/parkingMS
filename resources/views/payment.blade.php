<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay for Parking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container col-6">
        <h2>Pay for Parking</h2>

        @if (session('success_message'))
            <div class="alert alert-success">{{ session('success_message') }}</div>
        @endif

        @if (session('error_message'))
            <div class="alert alert-danger">{{ session('error_message') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('parking.payment.process') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="car_plate_number">RFID Card Number</label>
                <input type="text" class="form-control" id="car_plate_number" name="car_plate_number"
                    value="{{ old('car_plate_number') }}" placeholder="Enter Car Plate Number">
            </div>

            <div class="form-group">
                <label for="card_number">Account Number</label>
                <input type="text" class="form-control" id="card_number" name="card_number"
                    value="{{ old('card_number') }}" placeholder="Enter Card Number">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="expiry_date">Expiry Date (MM/YY)</label>
                    <input type="text" class="form-control" id="expiry_date" name="expiry_date"
                        value="{{ old('expiry_date') }}" placeholder="MM/YY">
                </div>

                <div class="form-group col-md-6">
                    <label for="cvc">CVV</label>
                    <input type="number" class="form-control" id="cvc" name="cvc" value="{{ old('cvc') }}"
                        placeholder="Enter CVC">
                </div>
            </div>
            <div class="row col-5">
                <button type="submit" class="btn btn-primary text-center"> Pay </button>
            </div>

        </form>

    </div>
</body>

</html>
