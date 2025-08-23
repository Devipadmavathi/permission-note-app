@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-info text-white">
        <h4>{{ $note->title }}</h4>
    </div>
    <div class="card-body">
        <p>{{ $note->content }}</p>
        <p class="text-muted">Created: {{ $note->created_at->format('d M Y, h:i A') }}</p>
        <a href="{{ route('notes.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
