<?php

namespace App\Services;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteSearchService
{
    public function search($search = null)
    {
        $query = Note::where('user_id', Auth::id())->with('tags');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        return $query->paginate(10);
    }
}
