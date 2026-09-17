<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display the task list.
     */
    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();
        $search = $request->string('search')->trim()->toString();

        if (! in_array($status, [Task::STATUS_PENDING, Task::STATUS_COMPLETED], true)) {
            $status = 'all';
        }

        $tasks = Task::query()
            ->when($status !== 'all', fn ($query) => $query->where('status', $status))
            ->when($search !== '', fn ($query) => $query->where('title', 'like', '%'.$search.'%'))
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks', 'status', 'search'));
    }

    /**
     * Show the form for creating a task.
     */
    public function create(): View
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        Task::create($request->validated());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Show the form for editing a task.
     */
    public function edit(Task $task): View
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the given task.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Mark the given task as completed.
     */
    public function complete(Task $task): RedirectResponse
    {
        $task->update(['status' => Task::STATUS_COMPLETED]);

        return back()->with('success', 'Task marked as completed.');
    }

    /**
     * Delete the given task.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return back()->with('success', 'Task deleted successfully.');
    }
}
