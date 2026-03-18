@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary">Adăugare Activitate</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nume</label>
                        <input type="text" name="nume" class="form-control" placeholder="Introdu numele activității" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Descriere</label>
                        <textarea name="descriere" class="form-control" rows="3" placeholder="Detalii despre task" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Stare</label>
                        <select name="stare" class="form-select">
                            <option value="În curs">În curs</option>
                            <option value="Finalizată">Finalizată</option>
                            <option value="Anulată">Anulată</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('tasks.index') }}" class="btn btn-light px-4">Anulează</a>
                        <button type="submit" class="btn btn-primary px-4">Salvează</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection