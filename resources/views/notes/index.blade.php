@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
            📒 My Notes
        </h2>
        <a href="{{ route('notes.create') }}"
           class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-lg shadow hover:opacity-90 transition">
            + Add Note
        </a>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($notes as $note)
            <div class="rounded-xl shadow-lg p-5 border border-gray-200 hover:shadow-2xl transition
                        bg-gradient-to-br from-pink-200 via-purple-200 to-blue-200">

                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $note->title }}</h3>
                <p class="text-gray-800 mb-4 leading-relaxed">{{ $note->body }}</p>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('notes.edit', $note) }}"
                       class="px-3 py-1 rounded-lg text-sm font-medium bg-yellow-400 text-white hover:bg-yellow-500 transition">
                        ✏️ Edit
                    </a>
                    <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Delete this note?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-3 py-1 rounded-lg text-sm font-medium bg-red-500 text-white hover:bg-red-600 transition">
                            🗑 Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No notes created yet. Start by adding one!</p>
        @endforelse
    </div>
@endsection
