<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();

        $totalTasks = Task::count();

        $completedTasks = Task::where('status', 'done')->count();

        $overdueTasks = Task::whereDate('due_date', '<', now())
            ->where('status', '!=', 'done')
            ->count();

        $recentProjects = Project::latest()
            ->take(5)
            ->get();

        $recentTasks = Task::latest()
            ->take(5)
            ->get();

        $progressPercentage = $totalTasks > 0
            ? round(($completedTasks / $totalTasks) * 100)
            : 0;

        return view('dashboard.index', compact(
            'totalProjects',
            'totalTasks',
            'completedTasks',
            'overdueTasks',
            'recentProjects',
            'recentTasks',
            'progressPercentage'
        ));
    }
}