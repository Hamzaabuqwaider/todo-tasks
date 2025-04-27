<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request) {
        $users = User::all();
        return view('tasks.create',['users'=>$users]);
    }

    public function store(TaskRequest $request)
    {
        $validated = $request->validated();

        Task::create($validated);

        return redirect()
            ->route('tasks.create')
            ->with('message', 'Task created successfully!');
    }
}
