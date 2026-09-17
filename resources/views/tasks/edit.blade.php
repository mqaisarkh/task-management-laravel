@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <div class='row justify-content-center'>
        <div class='col-lg-7'>
            <header class='mb-4'>
                <h1 class='h2 fw-semibold mb-2'>Edit Task</h1>
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
@endsection
