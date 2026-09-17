<!DOCTYPE html>
<html lang='{{ str_replace('_', '-', app()->getLocale()) }}'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Add Task</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body class='bg-body-tertiary min-vh-100'>
    <main class='container py-5'>
        <div class='row justify-content-center'>
            <div class='col-lg-7'>
                <header class='mb-4'>
                    <h1 class='display-6 fw-semibold mb-2'>Add Task</h1>
                    <p class='text-body-secondary mb-0'>Enter the task details below.</p>
                </header>

                <section class='card border-0 shadow-sm'>
                    <div class='card-body p-4'>
                        <form action='{{ route('tasks.store') }}' method='POST'>
                            @csrf

                            <div class='mb-3'>
                                <label for='title' class='form-label'>Title</label>
                                <input
                                    type='text'
                                    id='title'
                                    name='title'
                                    value='{{ old('title') }}'
                                    maxlength='255'
                                    class='form-control @error('title') is-invalid @enderror'
                                    autofocus
                                >
                                @error('title')
                                    <div class='invalid-feedback'>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class='mb-3'>
                                <label for='description' class='form-label'>Description</label>
                                <textarea
                                    id='description'
                                    name='description'
                                    rows='4'
                                    maxlength='2000'
                                    class='form-control @error('description') is-invalid @enderror'
                                >{{ old('description') }}</textarea>
                                @error('description')
                                    <div class='invalid-feedback'>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class='row'>
                                <div class='col-md-6 mb-3'>
                                    <label for='status' class='form-label'>Status</label>
                                    <select id='status' name='status' class='form-select @error('status') is-invalid @enderror'>
                                        <option value='pending' @selected(old('status', 'pending') === 'pending')>Pending</option>
                                        <option value='completed' @selected(old('status') === 'completed')>Completed</option>
                                    </select>
                                    @error('status')
                                        <div class='invalid-feedback'>{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class='col-md-6 mb-3'>
                                    <label for='due_date' class='form-label'>Due date</label>
                                    <input
                                        type='date'
                                        id='due_date'
                                        name='due_date'
                                        value='{{ old('due_date') }}'
                                        class='form-control @error('due_date') is-invalid @enderror'
                                    >
                                    @error('due_date')
                                        <div class='invalid-feedback'>{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class='d-flex justify-content-end gap-2 mt-2'>
                                <a href='{{ route('tasks.index') }}' class='btn btn-outline-secondary'>Cancel</a>
                                <button type='submit' class='btn btn-primary'>Create Task</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </main>
</body>
</html>
