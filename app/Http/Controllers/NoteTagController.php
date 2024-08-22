<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteTagController extends Controller
{
    public function index($tagId)
    {
        $selected_tag = Tag::findOrFail($tagId);
        $notes = $selected_tag->notes()->where('user_id', Auth::id())->paginate(5);

        return view('notes.index', compact('notes', 'selected_tag'));
    }
}
