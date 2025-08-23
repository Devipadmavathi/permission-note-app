@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4>All Notes</h4>
    </div>
    <div class="card-body">
        @if($notes->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notes as $note)
                        <tr>
                            <td>{{ $note->title }}</td>
                            <td>{{ Str::limit($note->content, 50) }}</td>
                            <td>{{ $note->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('notes.show', $note->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">No notes found. Create one!</p>
        @endif
    </div>
</div>
@endsection
