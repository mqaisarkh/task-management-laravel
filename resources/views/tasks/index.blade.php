@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <header class='d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4'>
        <div>
            <h1 class='h2 fw-semibold mb-2'>Your Tasks</h1>
            <p class='text-body-secondary mb-0'>Keep track of your pending and completed work.</p>
        </div>

        <nav class='btn-group' aria-label='Filter tasks by status'>
            <a href='{{ route('tasks.index', ['search' => $search]) }}' class='btn {{ $status === 'all' ? 'btn-primary' : 'btn-outline-primary' }}'>All</a>
            <a href='{{ route('tasks.index', ['status' => 'pending', 'search' => $search]) }}' class='btn {{ $status === 'pending' ? 'btn-primary' : 'btn-outline-primary' }}'>Pending</a>
            <a href='{{ route('tasks.index', ['status' => 'completed', 'search' => $search]) }}' class='btn {{ $status === 'completed' ? 'btn-primary' : 'btn-outline-primary' }}'>Completed</a>
        </nav>
    </header>

    <form action='{{ route('tasks.index') }}' method='GET' class='card border-0 shadow-sm mb-4'>
        <div class='card-body'>
            @if ($status !== 'all')
                <input type='hidden' name='status' value='{{ $status }}'>
            @endif

            <div class='input-group'>
                <input
                    type='search'
                    name='search'
                    value='{{ $search }}'
                    maxlength='100'
                    class='form-control'
                    placeholder='Search tasks by title'
                    aria-label='Search tasks by title'
                >
                <button type='submit' class='btn btn-primary'>Search</button>
                @if ($search !== '')
                    <a href='{{ route('tasks.index', $status === 'all' ? [] : ['status' => $status]) }}' class='btn btn-outline-secondary'>Clear</a>
                @endif
            </div>
        </div>
    </form>

    <section class='card border-0 shadow-sm'>
        @if ($tasks->isEmpty())
            <div class='card-body py-5 text-center'>
                <h2 class='h5 mb-2'>No tasks found</h2>
                <p class='text-body-secondary mb-3'>Try a different search or status filter, or create a new task.</p>
                <a href='{{ route('tasks.create') }}' class='btn btn-primary'>Add your first task</a>
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
                            <tr class='{{ $task->status === 'completed' ? 'opacity-75' : ($task->isOverdue() ? 'table-danger' : '') }}'>
                                <td class='px-4 py-3'>
                                    <div class='fw-semibold {{ $task->status === 'completed' ? 'text-decoration-line-through' : '' }}'>
                                        {{ $task->title }}
                                    </div>
                                    @if ($task->description)
                                        <div class='small text-body-secondary mt-1'>{{ $task->description }}</div>
                                    @endif
                                </td>
                                <td class='px-4 py-3 text-nowrap {{ $task->isOverdue() ? 'text-danger fw-semibold' : '' }}'>
                                    {{ $task->due_date?->format('M d, Y') ?? 'No due date' }}
                                </td>
                                <td class='px-4 py-3'>
                                    <span class='badge rounded-pill {{ $task->status === 'completed' ? 'text-bg-success' : 'text-bg-warning' }}'>
                                        {{ ucfirst($task->status) }}
                                    </span>
                                    @if ($task->isOverdue())
                                        <span class='badge rounded-pill text-bg-danger ms-1'>Overdue</span>
                                    @endif
                                </td>
                                <td class='px-4 py-3 text-end'>
                                    <div class='d-inline-flex flex-wrap justify-content-end gap-2'>
                                        @if ($task->status === 'pending')
                                            <form action='{{ route('tasks.complete', $task) }}' method='POST'>
                                                @csrf
                                                @method('PATCH')
                                                <button type='submit' class='btn btn-sm btn-outline-success'>Complete</button>
                                            </form>
                                        @endif

                                        <a href='{{ route('tasks.edit', $task) }}' class='btn btn-sm btn-outline-primary'>Edit</a>

                                        <form action='{{ route('tasks.destroy', $task) }}' method='POST' onsubmit='return confirm(&quot;Delete this task?&quot;)'>
                                            @csrf
                                            @method('DELETE')
                                            <button type='submit' class='btn btn-sm btn-outline-danger'>Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection
