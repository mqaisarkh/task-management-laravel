<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
}
