@extends('layouts.app')

@section('title', 'Add Task')

@section('content')
    <div class='row justify-content-center'>
        <div class='col-lg-7'>
            <header class='mb-4'>
                <h1 class='h2 fw-semibold mb-2'>Add Task</h1>
                <p class='text-body-secondary mb-0'>Enter the task details below.</p>
            </header>

            <section class='card border-0 shadow-sm'>
                <div class='card-body p-4'>
                    <form action='{{ route('tasks.store') }}' method='POST'>
                        @csrf
                        @include('tasks._form', ['task' => null, 'submitLabel' => 'Create Task'])
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
