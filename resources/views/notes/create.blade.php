@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">📝 Create a New Note</h2>

    <form action="{{ route('notes.store') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input type="text" name="title" id="title"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                   placeholder="Enter note title..." required>
        </div>

        <!-- Body -->
        <div>
            <label for="body" class="block text-sm font-medium text-gray-700 mb-2">Body</label>
            <textarea name="body" id="body" rows="4"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                      placeholder="Write your note details here..." required></textarea>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('notes.index') }}"
               class="px-5 py-2 rounded-lg bg-gray-300 text-gray-700 font-medium hover:bg-gray-400 transition">
                Cancel
            </a>
            <button type="submit"
                    class="px-5 py-2 rounded-lg bg-gradient-to-r from-green-500 to-emerald-600 text-white font-medium shadow hover:opacity-90 transition">
                💾 Save Note
            </button>
        </div>
    </form>
</div>
@endsection
