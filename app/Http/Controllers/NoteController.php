<?php


namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Models\Tag;
use App\Services\NoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    protected $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function index()
    {
        $notes = $this->noteService->getUserNotes();
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        $tags = $this->noteService->getAllTags();
        return view('notes.create', compact('tags'));
    }

    public function store(NoteRequest $request)
    {
        $this->noteService->createNoteWithTags(
            $request->validated(),
            $request->tags,
            $request->new_tag
        );

        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    public function edit($id)
    {
        $note = Note::findOrFail($id);
        $tags = $this->noteService->getAllTags();
        return view('notes.edit', compact('note', 'tags'));
    }

    public function update(NoteRequest $request, $id)
    {
        $note = Note::findOrFail($id);

        $this->noteService->updateNoteWithTags($note, $request->validated(), $request->tags);

        return redirect()->route('notes.index')->with('success', 'Note updated successfully!');
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $this->noteService->deleteNote($note);
        return redirect()->route('notes.index');
    }


}
