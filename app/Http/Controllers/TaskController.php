<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->search;

        $taskQuery = Task::with('user')
            ->where('is_completed', 0);

        if($search) {
            $taskQuery->where('title', 'LIKE', "%{$search}%");
        }

        $tasks = $taskQuery->paginate(10)->withQueryString();

        return inertia('Task/Index', [
            'tasks' => $tasks,
            'filters' => $request->only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Task/Create', [
            'users' => User::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $attr = $request->validate([
            'title' => 'required|string',
            'due_date' => 'required|string',
            'user_id' => 'required',
        ]);

        // dd($attr);
        Task::create($attr);

        return redirect('/tasks')->with('success', 'Task has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task->load('user');

        return inertia('Task/Show', [
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return inertia('Task/Edit', [
            'task' => $task,
            'users' => User::orderBy('name', 'asc')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // dd($request->all());
        $attr = $request->validate([
            'title' => 'required|string',
            'due_date' => 'required',
            'user_id' => 'required',
        ]);

        // dd($attr);
        $task->update($attr);

        return redirect('/tasks')->with('success', 'Task details has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/tasks')->with('success', 'Task has been removed.');
    }

    public function toggleComplete(Task $task)
    {
        $task->is_completed = !$task->is_completed;

        $task->save();

        return back()->with('success', 'Task has been marked completed.');
    }
}
