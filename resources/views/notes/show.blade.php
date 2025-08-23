@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $note->title }}</h2>
    <p>{{ $note->body }}</p>

    <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('notes.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
