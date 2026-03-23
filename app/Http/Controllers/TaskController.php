<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    private const NORMALIZED_STATUSES = [
        'In curs',
        'Finalizata',
        'Anulata',
    ];

    private const ACCEPTED_STATUSES = [
        'În curs',
        'Finalizată',
        'Anulată',
        'In curs',
        'Finalizata',
        'Anulata',
    ];

    public function index()
    {
        $tasks = Task::latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nume' => ['required', 'string', 'max:255'],
            'descriere' => ['required', 'string'],
            'stare' => ['required', Rule::in(self::ACCEPTED_STATUSES)],
        ]);

        $validated['stare'] = $this->normalizeStatus($validated['stare']);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Activitate adaugata cu succes.');
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
        $validated = $request->validate([
            'nume' => ['required', 'string', 'max:255'],
            'descriere' => ['required', 'string'],
            'stare' => ['required', Rule::in(self::ACCEPTED_STATUSES)],
        ]);

        $validated['stare'] = $this->normalizeStatus($validated['stare']);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Activitate actualizata cu succes.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Activitate stearsa cu succes.');
    }

    private function normalizeStatus(string $status): string
    {
        $statusKey = Str::of($status)->lower()->ascii()->value();

        if (str_contains($statusKey, 'final')) {
            return self::NORMALIZED_STATUSES[1];
        }

        if (str_contains($statusKey, 'anulat')) {
            return self::NORMALIZED_STATUSES[2];
        }

        return self::NORMALIZED_STATUSES[0];
    }
}
