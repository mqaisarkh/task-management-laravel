<!DOCTYPE html>
<html lang='{{ str_replace('_', '-', app()->getLocale()) }}'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>@yield('title', 'Task Manager')</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body class='bg-body-tertiary min-vh-100'>
    <nav class='navbar navbar-expand bg-primary shadow-sm' data-bs-theme='dark'>
        <div class='container'>
            <a class='navbar-brand fw-semibold' href='{{ route('tasks.index') }}'>Task Manager</a>
            <a class='btn btn-light btn-sm' href='{{ route('tasks.create') }}'>Add Task</a>
        </div>
    </nav>

    <main class='container py-5'>
        @if (session('success'))
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                {{ session('success') }}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js'></script>
</body>
</html>
