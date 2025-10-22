<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $tasksQuery = Auth::user()->tasks();

        if ($filter == 'active') {
            $tasksQuery->where('is_complete', false);
        } elseif ($filter == 'completed') {
            $tasksQuery->where('is_complete', true);
        }

        $tasks = $tasksQuery->latest()->get();

        $tasksRemaining = Auth::user()->tasks()->where('is_complete', false)->count();

        return view('dashboard', [
            'tasks' => $tasks,
            'tasksRemaining' => $tasksRemaining,
            'filter' => $filter
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);

        Auth::user()->tasks()->create([
            'title' => $request->title,
            'is_complete' => false
        ]);

        return redirect()->route('dashboard')->with('success', 'Task added successfully!');
    }

    public function update(Task $task)
    {
        if ($task->user_id != Auth::id()) {
            abort(403);
        }

        $task->is_complete = !$task->is_complete;
        $task->save();

        return redirect()->route('dashboard');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id != Auth::id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Task removed succesfully.');
    }

    public function destroyCompleted()
    {
        Auth::user()->tasks()->where('is_complete', true)->delete();

        return redirect()->route('dashboard')->with('success', 'All task have been cleared.');
    }
}