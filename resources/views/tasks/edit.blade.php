@extends('layouts.app')

@section('title', 'Editare Activitate')

@section('content')
@php
    $statusOptions = ['În curs', 'Finalizată', 'Anulată'];
    $statusKey = \Illuminate\Support\Str::of((string) $task->stare)->lower()->ascii()->value();
    $taskStatus = 'În curs';

    if (str_contains($statusKey, 'final')) {
        $taskStatus = 'Finalizată';
    } elseif (str_contains($statusKey, 'anulat')) {
        $taskStatus = 'Anulată';
    }
@endphp

<section class="page-hero fade-up">
    <span class="page-eyebrow">Actualizare task</span>
    <h1 class="page-title">Editează activitatea #{{ $task->id }}</h1>
    <p class="page-subtitle">Ajustează informațiile pentru a păstra progresul proiectului mereu actualizat.</p>
</section>

<div class="row justify-content-center">
    <div class="col-lg-9 col-xl-8">
        <section class="content-card form-card fade-up">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>Există câteva câmpuri invalide:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="row g-3 g-lg-4">
                @csrf
                @method('PUT')

                <div class="col-12">
                    <label for="nume" class="form-label">Nume activitate</label>
                    <input id="nume" type="text" name="nume" value="{{ old('nume', $task->nume) }}" class="form-control" required>
                </div>

                <div class="col-12">
                    <label for="descriere" class="form-label">Descriere</label>
                    <textarea id="descriere" name="descriere" class="form-control" required>{{ old('descriere', $task->descriere) }}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="stare" class="form-label">Status</label>
                    <select id="stare" name="stare" class="form-select" required>
                        @foreach($statusOptions as $status)
                            <option value="{{ $status }}" {{ old('stare', $taskStatus) === $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 d-flex flex-wrap justify-content-end gap-2 pt-2">
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-outline-secondary px-4">Înapoi</a>
                    <button type="submit" class="btn btn-brand px-4">Salvează modificările</button>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
