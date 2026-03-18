@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 mb-0">{{ $task->nume }}</h2>
                    <span class="badge {{ $task->stare == 'Finalizată' ? 'bg-success' : ($task->stare == 'Anulată' ? 'bg-danger' : 'bg-warning text-dark') }}">
                        {{ $task->stare }}
                    </span>
                </div>
                <p class="text-muted border-bottom pb-3">{{ $task->descriere }}</p>
                <div class="row text-center">
                    <div class="col-6 text-start">
                        <small class="d-block text-secondary">Creat la:</small>
                        <span>{{ $task->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="col-6 text-start">
                        <small class="d-block text-secondary">Ultima modificare:</small>
                        <span>{{ $task->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Înapoi la listă</a>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Editează</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection