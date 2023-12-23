<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class CompletedTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('is_completed', 1)
            ->with('user')
            ->paginate(10);

        return inertia('CompletedTask/Index', [
            'tasks' => $tasks
        ]);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return back()->with('success', 'Task has been deleted.');
    }
}
