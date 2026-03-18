<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nume' => 'required',
            'descriere' => 'required',
            'stare' => 'required|in:În curs,Finalizată,Anulată',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Activitate adăugată cu succes!');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'nume' => 'required',
            'descriere' => 'required',
            'stare' => 'required|in:În curs,Finalizată,Anulată',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Activitate actualizată!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Activitate ștearsă!');
    }
}