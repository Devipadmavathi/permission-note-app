<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    // Show all notes
    public function index()
    {
        $notes = Note::where('user_id', Auth::id())->latest()->get();
        return view('notes.index', compact('notes'));
    }

    // Show create form
    public function create()
    {
        return view('notes.create');
    }

    // Store new note
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Note::create([
            'title'   => $validated['title'],
            'body'    => $validated['body'],
            'user_id' => Auth::id(), // important for multi-user
        ]);

        return redirect()->route('notes.index')
                         ->with('success', 'Note created successfully.');
    }

    // Show single note
    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    // Edit form
    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    // Update note
    public function update(Request $request, Note $note)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index')
                         ->with('success', 'Note updated successfully.');
    }

    // Delete note
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('notes.index')
                         ->with('success', 'Note deleted successfully.');
    }
}
