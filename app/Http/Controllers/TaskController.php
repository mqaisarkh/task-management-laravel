<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
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

        if (! in_array($status, [Task::STATUS_PENDING, Task::STATUS_COMPLETED], true)) {
            $status = 'all';
        }

        $tasks = Task::query()
            ->when($status !== 'all', fn ($query) => $query->where('status', $status))
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks', 'status'));
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
}
