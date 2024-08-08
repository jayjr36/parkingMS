<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #333;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        .nav-pills .nav-link {
            border-radius: 30px;
            transition: background-color 0.3s, transform 0.3s;
            text-align: center;
            padding: 15px 20px;
            font-weight: 500;
            color: #fff;
            background-color: #007bff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .nav-pills .nav-link:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .nav-pills .nav-link.active {
            background-color: #0056b3;
            color: #ffffff;
        }

        .nav-item {
            margin-bottom: 20px;
        }

        @media (min-width: 768px) {
            .nav-item {
                margin-bottom: 0;
            }

            .nav-pills {
                justify-content: center;
            }
        }

        .nav-link {
            min-width: 200px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Admin Dashboard</h3>
        <ul class="nav nav-pills flex-column flex-sm-row">
            <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('admin.users') }}">Manage Users</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('admin.stafflist') }}">Staff Details</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('admin.payments.all') }}">Payment Details</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('parking.slots.index') }}">Parkings</a>
            </li>
        </ul>
    </div>
    
</body>

</html>
