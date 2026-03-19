@extends('layouts.app')

@section('title', 'Detalii Activitate')

@section('content')
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

<section class="page-hero fade-up">
    <span class="page-eyebrow">Fisa activitate</span>
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <h1 class="page-title mb-0">{{ $task->nume }}</h1>
        <span class="{{ $statusClass }}">{{ $statusLabel }}</span>
    </div>
    <p class="page-subtitle">Vizualizeaza contextul complet si urmareste evolutia task-ului in timp.</p>
</section>

<section class="content-card fade-up">
    <h2 class="h5 mb-3">Descriere</h2>
    <p class="task-description-box mb-4">{{ $task->descriere }}</p>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="info-tile">
                <span class="info-label">Data crearii</span>
                <span class="info-value">{{ $task->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-tile">
                <span class="info-label">Ultima actualizare</span>
                <span class="info-value">{{ $task->updated_at->format('d M Y, H:i') }}</span>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2 justify-content-end">
        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Inapoi la lista</a>
        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-brand">Editeaza activitatea</a>
    </div>
</section>
@endsection
