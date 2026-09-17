<div class='mb-3'>
    <label for='title' class='form-label'>Title</label>
    <input
        type='text'
        id='title'
        name='title'
        value='{{ old('title', $task?->title) }}'
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
    >{{ old('description', $task?->description) }}</textarea>
    @error('description')
        <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
</div>

<div class='row'>
    <div class='col-md-6 mb-3'>
        <label for='status' class='form-label'>Status</label>
        <select id='status' name='status' class='form-select @error('status') is-invalid @enderror'>
            <option value='pending' @selected(old('status', $task?->status ?? 'pending') === 'pending')>Pending</option>
            <option value='completed' @selected(old('status', $task?->status) === 'completed')>Completed</option>
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
            value='{{ old('due_date', $task?->due_date?->format('Y-m-d')) }}'
            class='form-control @error('due_date') is-invalid @enderror'
        >
        @error('due_date')
            <div class='invalid-feedback'>{{ $message }}</div>
        @enderror
    </div>
</div>

<div class='d-flex justify-content-end gap-2 mt-2'>
    <a href='{{ route('tasks.index') }}' class='btn btn-outline-secondary'>Cancel</a>
    <button type='submit' class='btn btn-primary'>{{ $submitLabel }}</button>
</div>
