@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h4>Create New Note</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('notes.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Note</button>
            <a href="{{ route('notes.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
