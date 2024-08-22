<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Services\NoteSearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteSearchController extends Controller
{
    protected $noteSearchService;

    public function __construct(NoteSearchService $noteSearchService)
    {
        $this->noteSearchService = $noteSearchService;
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $notes = $this->noteSearchService->search($search);

        return view('notes.index', compact('notes'));
    }
}
