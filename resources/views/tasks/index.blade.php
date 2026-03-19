@extends('layouts.app')

@section('title', 'Dashboard TaskFlow')

@section('content')
@php
    $totalTasks = $tasks->count();
    $completedTasks = $tasks->filter(fn ($task) => str_contains(strtolower((string) $task->stare), 'final'))->count();
    $cancelledTasks = $tasks->filter(fn ($task) => str_contains(strtolower((string) $task->stare), 'anulat'))->count();
    $activeTasks = max($totalTasks - $completedTasks - $cancelledTasks, 0);
    $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
@endphp

<section class="page-hero fade-up">
    <div class="d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-3">
        <div>
            <span class="page-eyebrow">Panou principal</span>
            <h1 class="page-title">Task Manager Profesional</h1>
            <p class="page-subtitle">Vezi rapid progresul echipei si administreaza toate activitatile intr-un singur loc.</p>
        </div>
        <div>
            <a href="{{ route('tasks.create') }}" class="btn btn-brand px-4 py-2">Adauga activitate</a>
        </div>
    </div>
</section>

<section class="stat-grid fade-up">
    <article class="stat-card">
        <span class="stat-label">Total activitati</span>
        <p class="stat-value mb-1">{{ $totalTasks }}</p>
        <span class="stat-note">Task-uri inregistrate</span>
    </article>
    <article class="stat-card">
        <span class="stat-label">In lucru</span>
        <p class="stat-value mb-1">{{ $activeTasks }}</p>
        <span class="stat-note">Activitati active</span>
    </article>
    <article class="stat-card">
        <span class="stat-label">Finalizate</span>
        <p class="stat-value mb-1">{{ $completedTasks }}</p>
        <span class="stat-note">Task-uri completate</span>
    </article>
    <article class="stat-card">
        <span class="stat-label">Rata progres</span>
        <p class="stat-value mb-1">{{ $completionRate }}%</p>
        <span class="stat-note">Eficienta curenta</span>
    </article>
</section>

<section class="content-card fade-up">
    @if($tasks->isEmpty())
        <div class="empty-state">
            <h2 class="empty-title">Inca nu exista activitati</h2>
            <p class="text-secondary mb-4">Porneste fluxul de lucru adaugand primul task din proiect.</p>
            <a href="{{ route('tasks.create') }}" class="btn btn-brand px-4">Creeaza primul task</a>
        </div>
    @else
        <div class="table-wrap table-responsive">
            <table class="table task-table align-middle">
                <thead>
                    <tr>
                        <th style="width: 84px;" class="ps-3">ID</th>
                        <th>Activitate</th>
                        <th style="width: 180px;">Status</th>
                        <th style="width: 190px;">Creat</th>
                        <th style="width: 280px;" class="text-end pe-3">Actiuni</th>
                    </tr>
                </thead>
                <tbody class="stagger">
                    @foreach($tasks as $task)
                        @php
                            $statusText = (string) $task->stare;
                            $statusKey = strtolower($statusText);
                            $statusClass = 'status-pill status-pill--progress';
                            $statusLabel = 'In curs';

                            if (str_contains($statusKey, 'final')) {
                                $statusClass = 'status-pill status-pill--done';
                                $statusLabel = 'Finalizata';
                            } elseif (str_contains($statusKey, 'anulat')) {
                                $statusClass = 'status-pill status-pill--cancel';
                                $statusLabel = 'Anulata';
                            }
                        @endphp
                        <tr>
                            <td class="ps-3 text-secondary fw-semibold">#{{ $task->id }}</td>
                            <td>
                                <a href="{{ route('tasks.show', $task->id) }}" class="task-title">{{ $task->nume }}</a>
                                <p class="task-description">{{ \Illuminate\Support\Str::limit($task->descriere, 95) }}</p>
                            </td>
                            <td>
                                <span class="{{ $statusClass }}">{{ $statusLabel }}</span>
                            </td>
                            <td class="text-secondary">{{ $task->created_at->format('d M Y, H:i') }}</td>
                            <td class="text-end pe-3">
                                <div class="actions-group">
                                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-outline-brand">Detalii</a>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-dark">Editare</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Sigur doresti sa stergi acest task?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Sterge</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>
@endsection
