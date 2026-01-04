<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krojački Salon</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark mb-4" style="background-color: #28a745;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav w-100 align-items-center">
                    
                    <a class="nav-link fw-bold me-3 {{ request()->routeIs('ponuda.dana') ? 'active-link' : 'text-white' }}" 
                       href="{{ route('ponuda.dana') }}">Ponuda dana</a>

                    <a class="nav-link fw-bold me-3 {{ request()->routeIs('products.index') ? 'active-link' : 'text-white' }}" 
                       href="{{ route('products.index') }}">Katalog</a>
                    
                    <a class="nav-link fw-bold me-3 {{ request()->routeIs('appointments.create') ? 'active-link' : 'text-white' }}" 
                       href="{{ route('appointments.create') }}">Termin</a>

                    @auth
                        @if(auth()->user()->is_admin)
                            <a class="nav-link fw-bold me-3 {{ request()->routeIs('admin.dashboard') ? 'active-link' : 'text-warning' }}" 
                               href="{{ route('admin.dashboard') }}">
                               <i class="bi bi-gear-fill"></i> Admin Panel
                            </a>
                        @endif
                    @endauth
                    
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="ms-auto mb-0">
                            @csrf
                            <button type="submit" class="nav-link fw-bold text-white border-0 bg-transparent px-3 py-2">
                                Logout ({{ auth()->user()->name }})
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<style>
    /* Boja za link koji NIJE aktivan kada se pređe mišem */
    .nav-link:hover {
        color: #d4edda !important; /* Svetlo zelena na hover */
    }

    /* Boja za AKTIVAN link */
    .active-link {
        background-color: #1e7e34 !important; /* Tamno zelena */
        color: white !important;
        border-radius: 5px;
        padding-left: 10px !important;
        padding-right: 10px !important;
    }

    /* Posebna boja za Admin link da bi se istakao ako nije aktivan */
    .text-warning {
        color: #ffc107 !important;
    }
</style>