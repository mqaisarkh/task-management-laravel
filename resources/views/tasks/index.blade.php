<!DOCTYPE html>
<html lang='{{ str_replace('_', '-', app()->getLocale()) }}'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Tasks</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body class='bg-body-tertiary min-vh-100'>
    <main class='container py-5'>
        <div class='row justify-content-center'>
            <div class='col-lg-10'>
                <header class='d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4'>
                    <div>
                        <h1 class='display-6 fw-semibold mb-2'>Task Manager</h1>
                        <p class='text-body-secondary mb-0'>Keep track of your pending and completed tasks.</p>
                    </div>
                    <a href='{{ route('tasks.create') }}' class='btn btn-primary'>Add Task</a>
                </header>

                @if (session('success'))
                    <div class='alert alert-success' role='alert'>{{ session('success') }}</div>
                @endif

                <nav class='btn-group mb-4' aria-label='Filter tasks by status'>
                    <a href='{{ route('tasks.index') }}' class='btn {{ $status === 'all' ? 'btn-primary' : 'btn-outline-primary' }}'>All</a>
                    <a href='{{ route('tasks.index', ['status' => 'pending']) }}' class='btn {{ $status === 'pending' ? 'btn-primary' : 'btn-outline-primary' }}'>Pending</a>
                    <a href='{{ route('tasks.index', ['status' => 'completed']) }}' class='btn {{ $status === 'completed' ? 'btn-primary' : 'btn-outline-primary' }}'>Completed</a>
                </nav>

                <section class='card border-0 shadow-sm'>
                    @if ($tasks->isEmpty())
                        <div class='card-body py-5 text-center text-body-secondary'>
                            No tasks found.
                        </div>
                    @else
                        <div class='table-responsive'>
                            <table class='table table-hover align-middle mb-0'>
                                <thead class='table-light'>
                                    <tr>
                                        <th class='px-4 py-3'>Task</th>
                                        <th class='px-4 py-3'>Due date</th>
                                        <th class='px-4 py-3'>Status</th>
                                        <th class='px-4 py-3 text-end'>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td class='px-4 py-3'>
                                                <div class='fw-semibold'>{{ $task->title }}</div>
                                                @if ($task->description)
                                                    <div class='small text-body-secondary mt-1'>{{ $task->description }}</div>
                                                @endif
                                            </td>
                                            <td class='px-4 py-3 text-nowrap'>
                                                {{ $task->due_date?->format('M d, Y') ?? 'No due date' }}
                                            </td>
                                            <td class='px-4 py-3'>
                                                <span class='badge rounded-pill {{ $task->status === 'completed' ? 'text-bg-success' : 'text-bg-warning' }}'>
                                                    {{ ucfirst($task->status) }}
                                                </span>
                                            </td>
                                            <td class='px-4 py-3 text-end'>
                                                <a href='{{ route('tasks.edit', $task) }}' class='btn btn-sm btn-outline-primary'>Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </main>
</body>
</html>
