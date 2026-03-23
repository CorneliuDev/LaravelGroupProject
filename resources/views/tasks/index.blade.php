@extends('layouts.app')

@section('title', 'Dashboard TaskFlow')

@section('content')
@php
    $totalTasks = $tasks->count();
    $completedTasks = $tasks->filter(fn ($task) => str_contains(\Illuminate\Support\Str::of((string) $task->stare)->lower()->ascii()->value(), 'final'))->count();
    $cancelledTasks = $tasks->filter(fn ($task) => str_contains(\Illuminate\Support\Str::of((string) $task->stare)->lower()->ascii()->value(), 'anulat'))->count();
    $activeTasks = max($totalTasks - $completedTasks - $cancelledTasks, 0);
    $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
@endphp

<section class="page-hero fade-up">
    <div class="hero-layout d-flex flex-column flex-xl-row align-items-xl-end justify-content-between gap-4">
        <div>
            <span class="page-eyebrow">Panou principal</span>
            <h1 class="page-title">Task Manager Profesional</h1>
            <p class="page-subtitle">Vezi rapid progresul echipei si administreaza toate activitatile intr-un singur loc, cu un tablou clar si usor de urmarit.</p>
        </div>
        <div class="hero-panel">
            <span class="hero-panel__label">Ritm echipa</span>
            <strong class="hero-panel__value">{{ $completionRate }}%</strong>
            <p class="hero-panel__text mb-0">din activitati sunt deja finalizate.</p>
            <a href="{{ route('tasks.create') }}" class="btn btn-brand px-4 py-2 mt-3">Adaugă activitate</a>
        </div>
    </div>
</section>

<section class="stat-grid fade-up">
    <article class="stat-card">
        <span class="stat-label">Total activități</span>
        <p class="stat-value mb-1">{{ $totalTasks }}</p>
        <span class="stat-note">Task-uri înregistrate</span>
    </article>
    <article class="stat-card">
        <span class="stat-label">În lucru</span>
        <p class="stat-value mb-1">{{ $activeTasks }}</p>
        <span class="stat-note">Activități active</span>
    </article>
    <article class="stat-card">
        <span class="stat-label">Finalizate</span>
        <p class="stat-value mb-1">{{ $completedTasks }}</p>
        <span class="stat-note">Task-uri completate</span>
    </article>
    <article class="stat-card">
        <span class="stat-label">Rată progres</span>
        <p class="stat-value mb-1">{{ $completionRate }}%</p>
        <span class="stat-note">Eficiență curentă</span>
    </article>
</section>

<section class="content-card fade-up">
    @if($tasks->isEmpty())
        <div class="empty-state">
            <h2 class="empty-title">Încă nu există activități</h2>
            <p class="text-secondary mb-4">Pornește fluxul de lucru adăugând primul task din proiect.</p>
            <a href="{{ route('tasks.create') }}" class="btn btn-brand px-4">Creeaza primul task</a>
        </div>
    @else
        <div class="section-heading d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-3">
            <div>
                <h2 class="section-title mb-1">Activități recente</h2>
                <p class="section-text mb-0">Lista este ordonată descrescător după data creării pentru acces rapid la ultimele modificări.</p>
            </div>
            <span class="section-badge">{{ $totalTasks }} în total</span>
        </div>
        <div class="table-wrap table-responsive">
            <table class="table task-table align-middle">
                <thead>
                    <tr>
                        <th style="width: 84px;" class="ps-3">ID</th>
                        <th>Activitate</th>
                        <th style="width: 180px;">Status</th>
                        <th style="width: 190px;">Creat</th>
                        <th style="width: 280px;" class="text-end pe-3">Acțiuni</th>
                    </tr>
                </thead>
                <tbody class="stagger">
                    @foreach($tasks as $task)
                        @php
                            $statusText = (string) $task->stare;
                            $statusKey = \Illuminate\Support\Str::of($statusText)->lower()->ascii()->value();
                            $statusClass = 'status-pill status-pill--progress';
                            $statusLabel = 'În curs';

                            if (str_contains($statusKey, 'final')) {
                                $statusClass = 'status-pill status-pill--done';
                                $statusLabel = 'Finalizată';
                            } elseif (str_contains($statusKey, 'anulat')) {
                                $statusClass = 'status-pill status-pill--cancel';
                                $statusLabel = 'Anulată';
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
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Sigur dorești să ștergi acest task?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Șterge</button>
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
