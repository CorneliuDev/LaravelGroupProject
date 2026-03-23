@extends('layouts.app')

@section('title', 'Activitate Noua')

@section('content')
@php
    $statusOptions = ['În curs', 'Finalizată', 'Anulată'];
@endphp

<section class="page-hero fade-up">
    <span class="page-eyebrow">Creare task</span>
    <h1 class="page-title">Adaugă o activitate nouă</h1>
    <p class="page-subtitle">Completează detaliile esențiale pentru o evidență clară a proiectului.</p>
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

            <form action="{{ route('tasks.store') }}" method="POST" class="row g-3 g-lg-4">
                @csrf
                <div class="col-12">
                    <label for="nume" class="form-label">Nume activitate</label>
                    <input id="nume" type="text" name="nume" value="{{ old('nume') }}" class="form-control" placeholder="Ex: Pregătire prezentare finală" required>
                </div>

                <div class="col-12">
                    <label for="descriere" class="form-label">Descriere</label>
                    <textarea id="descriere" name="descriere" class="form-control" placeholder="Introdu detalii relevante pentru task" required>{{ old('descriere') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="stare" class="form-label">Status</label>
                    <select id="stare" name="stare" class="form-select" required>
                        @foreach($statusOptions as $status)
                            <option value="{{ $status }}" {{ old('stare', 'În curs') === $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 d-flex flex-wrap justify-content-end gap-2 pt-2">
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary px-4">Renunță</a>
                    <button type="submit" class="btn btn-brand px-4">Salvează activitatea</button>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
