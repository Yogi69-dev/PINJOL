<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOEKU - @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table th, .table td {
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .display-6 {
                font-size: 1.5rem;
            }

            .card-header h4,
            .card-header h5 {
                font-size: 1.1rem;
            }

            .card {
                margin-bottom: 1rem;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-hand-holding-usd me-2"></i>DOEKU
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">
                            <i class="fas fa-home d-lg-none me-1"></i>
                            <span class="d-none d-lg-inline">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/loans">
                            <i class="fas fa-list d-lg-none me-1"></i>
                            <span class="d-none d-lg-inline">Pinjaman</span>
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function handleResponsiveCardShadow() {
            const cards = document.querySelectorAll('.card');
            if (window.innerWidth < 768) {
                cards.forEach(c => c.classList.remove('shadow', 'shadow-sm'));
            } else {
                cards.forEach(c => c.classList.add('shadow-sm'));
            }
        }

        window.addEventListener('load', handleResponsiveCardShadow);
        window.addEventListener('resize', handleResponsiveCardShadow);
    </script>

    @yield('scripts')
</body>
</html>
