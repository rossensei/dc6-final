<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // return inertia('Dashboard/AdminDashboard');

        if(auth()->user()->hasRole('Administrator')) {

            $userCount = User::count();

            $onGoingTasksCount = Task::where('is_completed', 0)->count();

            $completedTasksCount = Task::where('is_completed', 1)->count();

            return inertia('Dashboard/AdminDashboard', [
                'userCount' => $userCount,
                'onGoingTasksCount' => $onGoingTasksCount,
                'completedTasksCount' => $completedTasksCount,
            ]);
        } else if(auth()->user()->hasRole('Manager')) {

            $onGoingTasksCount = Task::where('is_completed', 0)->count();

            $completedTasksCount = Task::where('is_completed', 1)->count();

            return inertia('Dashboard/ManagerDashboard', [
                'onGoingTasksCount' => $onGoingTasksCount,
                'completedTasksCount' => $completedTasksCount,
            ]);
        } else {

            $myTasks = auth()->user()->tasks->where('is_completed', 0)->count();

            $myCompletedTasks = auth()->user()->tasks->where('is_completed', 1)->count();
            // dd($myTasks);
            return inertia('Dashboard/UserDashboard', [
                'myTasks' => $myTasks,
                'myCompletedTasks' => $myCompletedTasks,
            ]);
        }
    }
}
