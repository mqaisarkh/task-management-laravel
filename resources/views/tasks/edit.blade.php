<!DOCTYPE html>
<html lang='{{ str_replace('_', '-', app()->getLocale()) }}'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Edit Task</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body class='bg-body-tertiary min-vh-100'>
    <main class='container py-5'>
        <div class='row justify-content-center'>
            <div class='col-lg-7'>
                <header class='mb-4'>
                    <h1 class='display-6 fw-semibold mb-2'>Edit Task</h1>
                    <p class='text-body-secondary mb-0'>Update the task details below.</p>
                </header>

                <section class='card border-0 shadow-sm'>
                    <div class='card-body p-4'>
                        <form action='{{ route('tasks.update', $task) }}' method='POST'>
                            @csrf
                            @method('PUT')
                            @include('tasks._form', ['submitLabel' => 'Update Task'])
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </main>
</body>
</html>
