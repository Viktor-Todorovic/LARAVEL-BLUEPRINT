<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krojački Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand navbar-light bg-white border-bottom mb-4">
    <div class="container-fluid">
        <div class="navbar-nav w-100">
            <a class="nav-link fw-bold text-dark me-3" href="{{ route('products.index') }}">Katalog</a>
            
            <a class="nav-link fw-bold text-dark me-3" href="{{ route('appointments.create') }}">Termin</a>
            
            <a class="nav-link fw-bold text-danger ms-auto" href="#">Logout</a>
        </div>
    </div>
</nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>