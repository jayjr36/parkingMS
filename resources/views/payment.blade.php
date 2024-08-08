<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay for Parking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .btn-primary {
            background-color: #ff6f61;
            border-color: #ff6f61;
        }

        .btn-primary:hover {
            background-color: #ff4f41;
            border-color: #ff4f41;
        }

        .form-group label {
            font-weight: bold;
        }

        .alert {
            margin-top: 20px;
        }

        .form-row {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container col-md-6">
        <h2>Pay for Parking</h2>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
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
                <label for="card_number">RFID Card Number</label>
                <input type="text" class="form-control" id="card_number" name="card_number"
                    value="{{ old('card_number') }}" placeholder="Enter RFID Card Number">
            </div>

            <div class="form-group">
                <label for="account_number">Account Number</label>
                <input type="text" class="form-control" id="account_number" name="account_number"
                    value="{{ old('account_number') }}" placeholder="Enter Account Number">
            </div>

            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount"
                    value="{{ old('amount') }}" placeholder="Enter Amount">
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
                        placeholder="Enter CVV">
                </div>
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-success px-5">Pay</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    {{-- <script>
        $(document).ready(function() {
            $('#paymentForm').on('submit', function(e) {
                e.preventDefault();

                // Clear previous messages
                $('#messages').empty();

                $.ajax({
                    url: "{{ route('parking.payment.process') }}",
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#messages').append('<div class="alert alert-success">' + response.message + '</div>');
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var message = xhr.responseJSON.message || 'Something went wrong.';

                        if (xhr.status === 400) {
                            $('#messages').append('<div class="alert alert-danger">' + message + '</div>');
                        } else if (xhr.status === 404) {
                            $('#messages').append('<div class="alert alert-warning">' + message + '</div>');
                        } else {
                            $('#messages').append('<div class="alert alert-danger">An unexpected error occurred. Please try again.</div>');
                        }
                    }
                });
            });
        });
    </script> --}}
</body>

</html>
