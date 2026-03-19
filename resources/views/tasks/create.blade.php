@extends('layouts.app')

@section('title', 'Activitate Noua')

@section('content')
@php
    $statusOptions = ['In curs', 'Finalizata', 'Anulata'];
@endphp

<section class="page-hero fade-up">
    <span class="page-eyebrow">Creare task</span>
    <h1 class="page-title">Adauga o activitate noua</h1>
    <p class="page-subtitle">Completeaza detaliile esentiale pentru o evidenta clara a proiectului.</p>
</section>

<div class="row justify-content-center">
    <div class="col-lg-9 col-xl-8">
        <section class="content-card form-card fade-up">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>Exista cateva campuri invalide:</strong>
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
                    <input id="nume" type="text" name="nume" value="{{ old('nume') }}" class="form-control" placeholder="Ex: Pregatire prezentare finala" required>
                </div>

                <div class="col-12">
                    <label for="descriere" class="form-label">Descriere</label>
                    <textarea id="descriere" name="descriere" class="form-control" placeholder="Introdu detalii relevante pentru task" required>{{ old('descriere') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="stare" class="form-label">Status</label>
                    <select id="stare" name="stare" class="form-select" required>
                        @foreach($statusOptions as $status)
                            <option value="{{ $status }}" {{ old('stare', 'In curs') === $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 d-flex flex-wrap justify-content-end gap-2 pt-2">
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary px-4">Renunta</a>
                    <button type="submit" class="btn btn-brand px-4">Salveaza activitatea</button>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
