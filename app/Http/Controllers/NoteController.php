<?php


namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('user_id', Auth::id())->get();
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('notes.create', compact('tags'));
    }

    public function store(NoteRequest $request)
    {
        $note = new Note();
        $note->user_id = Auth::id();
        $note->fill($request->validated());
        $note->save();

        if ($request->has('tags')) {
            $note->tags()->sync($request->tags);
        }

        return redirect()->route('notes.index');
    }

    public function edit($id)
    {

        $note = Note::findOrFail($id);
        $tags = Tag::all();
        return view('notes.edit', compact('note', 'tags'));
    }

    public function update(NoteRequest $request, $id)
    {
        $note = Note::findOrFail($id);

        $note->update($request->validated());

        if ($request->has('tags')) {
            $note->tags()->sync($request->tags);
        }

        return redirect()->route('notes.index')->with('success', 'Note updated successfully!');
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete($id);
        return redirect()->route('notes.index');
    }

}
