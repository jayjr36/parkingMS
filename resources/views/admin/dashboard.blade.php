<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center">Admin Dashboard</h3>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link btn btn-secondary px-5" href="{{ route('admin.users') }}">Manage Users</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link btn btn-secondary px-5" href="{{ route('admin.stafflist') }}">Staff Details</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link btn btn-secondary px-5" href="{{ route('admin.payments.all') }}">Payment Details</a>
            </li>
        </ul>
    </div>
</body>
</html>
