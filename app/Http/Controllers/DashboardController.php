<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all notes (or only the authenticated user's notes if you have a user_id column)
        $notes = Note::latest()->get();

        return view('dashboard', compact('notes'));
    }
}
