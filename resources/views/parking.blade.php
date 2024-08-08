<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Slots</title>
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

        .table thead th {
            background-color: #ff6f61;
            color: #fff;
        }

        .badge {
            padding: 10px;
            font-size: 12px;
            border-radius: 5px;
        }

        .badge-available {
            background-color: #28a745;
            color: #fff;
        }

        .badge-occupied {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container col-md-8">
        <h2>Parking Slots Status</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Slot Number</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parkingSlots as $slot)
                    <tr>
                        <td>{{ $slot->slot_number }}</td>
                        <td>
                            @if ($slot->status == 'available')
                                <span class="badge badge-available">Available</span>
                            @else
                                <span class="badge badge-occupied">Occupied</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
