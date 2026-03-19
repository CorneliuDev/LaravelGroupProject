<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task Manager Profesional')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
</head>
<body>
    <div class="bg-orb bg-orb--one"></div>
    <div class="bg-orb bg-orb--two"></div>

    <header class="site-header sticky-top">
        <div class="container container-wide py-3">
            <nav class="navbar navbar-expand-lg navbar-shell px-3 px-lg-4">
                <a class="navbar-brand d-flex align-items-center gap-3 m-0" href="{{ route('tasks.index') }}">
                    <span class="brand-mark">TG</span>
                    <span>
                        <span class="d-block brand-title">TaskFlow</span>
                        <small class="brand-subtitle">Management clar pentru proiecte</small>
                    </span>
                </a>

                <div class="ms-auto d-flex align-items-center gap-2">
                    <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-brand">
                        Dashboard
                    </a>
                    <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-brand">
                        Adauga task
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <main class="site-main pb-4 pb-lg-5">
        <div class="container container-wide">
            @if(session('success'))
                <div class="alert alert-success alert-modern alert-dismissible fade show alert-auto-dismiss mt-2 mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="site-footer py-4">
        <div class="container container-wide d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <span class="small text-secondary">TaskFlow Dashboard</span>
            <span class="small text-secondary">Construit cu Laravel si Bootstrap</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alerts = document.querySelectorAll('.alert-auto-dismiss');
            alerts.forEach(function (alert) {
                setTimeout(function () {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    bsAlert.close();
                }, 3200);
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
