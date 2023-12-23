<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class UserCompletedTaskController extends Controller
{
    //

    public function index(Request $request)
    {
        // $myTasks = auth()->user()->tasks->where('is_completed', 0);

        $myTasks = Task::where('user_id', auth()->user()->id)
            ->where('is_completed', 1)
            ->paginate(10);

        return inertia('MyCompletedTask/Index', [
            'myTasks' => $myTasks
        ]);
    }

    public function toggleComplete(Task $task)
    {
        $task->is_completed = !$task->is_completed;

        $task->save();

        return back()->with('success', 'Your task has been marked completed.');
    }
}
