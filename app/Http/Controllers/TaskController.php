<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'stare' => 'nullable|in:În curs,Finalizată,Anulată',
            'sort' => 'nullable|in:id,nume,stare,created_at,updated_at',
            'direction' => 'nullable|in:asc,desc',
        ]);

        $sort = $validated['sort'] ?? 'created_at';
        $direction = $validated['direction'] ?? 'desc';

        $tasks = Task::query()
            ->when($validated['search'] ?? null, function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('nume', 'like', "%{$search}%")
                        ->orWhere('descriere', 'like', "%{$search}%");
                });
            })
            ->when($validated['stare'] ?? null, function ($query, $stare) {
                $query->where('stare', $stare);
            })
            ->orderBy($sort, $direction)
            ->get();

        return view('tasks.index', compact('tasks', 'validated', 'sort', 'direction'));
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