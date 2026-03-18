@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-5 mt-4">
        <h1 class="display-6 fw-bold text-secondary border-start border-4 border-primary ps-3">Gestiune Activități Proiect</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-lg shadow">
            + Adaugă Task
        </a>
    </div>

    <div class="card border-0 shadow-lg mb-5">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-primary text-uppercase small">
                        <tr>
                            <th class="py-3 ps-4"># ID</th>
                            <th>Nume Activitate</th>
                            <th>Stadiu</th>
                            <th>Data Înregistrării</th>
                            <th class="text-end pe-4">Acțiuni disponibile</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td class="ps-4 fw-light text-muted">{{ $task->id }}</td>
                            <td>
                                <a href="{{ route('tasks.show', $task->id) }}" class="text-decoration-none fw-semibold text-primary">
                                    {{ $task->nume }}
                                </a>
                            </td>
                            <td>
                                @if($task->stare == 'Finalizată')
                                    <span class="badge bg-success px-3 py-2 rounded-pill">Finalizată</span>
                                @elseif($task->stare == 'Anulată')
                                    <span class="badge bg-danger px-3 py-2 rounded-pill">Anulată</span>
                                @else
                                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill">În curs</span>
                                @endif
                            </td>
                            <td class="text-secondary small">{{ $task->created_at->diffForHumans() }}</td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-dark px-3">Modifică</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Sigur dorești eliminarea?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger px-3">Șterge</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection