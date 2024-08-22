<?php

namespace App\Services;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class NoteService
{

    public function getUserNotes($page = 5)
    {
        return Note::where('user_id', Auth::id())->with('tags')->paginate($page);

    }

    public function getAllTags()
    {
        return Tag::all();
    }

    public function createNoteWithTags($validatedData, $tags = [], $newTags = '')
    {
        $note = new Note();
        $note->user_id = Auth::id();
        $note->fill($validatedData);
        $note->save();

        if (!empty($tags)) {
            $note->tags()->sync($tags);
        }

        if (!empty($newTags)) {
            $newTagNames = array_filter(array_map('trim', explode(',', $newTags)));
            foreach ($newTagNames as $tagName) {
                $newTag = Tag::firstOrCreate(['name' => $tagName]);
                $note->tags()->attach($newTag->id);
            }
        }

        return $note;
    }

    public function updateNoteWithTags(Note $note, $validatedData, $tags = [])
    {
        $note->update($validatedData);

        if (!empty($tags)) {
            $note->tags()->sync($tags);
        }

        return $note;
    }

    public function deleteNote(Note $note)
    {
        $note->delete();
    }

}
