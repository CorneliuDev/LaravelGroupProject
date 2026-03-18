@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Panou Activități</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Adaugă Task
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Nume Activitate</th>
                        <th>Stare</th>
                        <th>Creat la</th>
                        <th class="text-end pe-4">Acțiuni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td class="ps-4 text-muted">{{ $task->id }}</td>
                        <td>
                            <a href="{{ route('tasks.show', $task->id) }}" class="text-decoration-none fw-bold text-dark">
                                {{ $task->nume }}
                            </a>
                        </td>
                        <td>
                            @if($task->stare == 'Finalizată')
                                <span class="badge rounded-pill bg-success-subtle text-success border border-success">Finalizată</span>
                            @elseif($task->stare == 'Anulată')
                                <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger">Anulată</span>
                            @else
                                <span class="badge rounded-pill bg-warning-subtle text-warning border border-warning text-dark">În curs</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $task->created_at->format('d/m/Y') }}</td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-warning">Editează</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Ștergi această activitate?')">
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
    </div>
</div>
@endsection