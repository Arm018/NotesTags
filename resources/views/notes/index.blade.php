@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Notes @isset($selected_tag) for Tag: {{ $selected_tag->name }} @endisset</h1>

        <form action="{{ route('notes.search') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search notes..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <a href="{{ route('notes.create') }}" class="btn btn-primary mb-3">Create New Note</a>

        @if($notes->isEmpty())
            <p>No notes found @isset($selected_tag) for this tag @endisset.</p>
        @else
            @foreach($notes as $note)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $note->title }}</h5>
                        <p class="card-text">{{ $note->description }}</p>


                        @if($note->tags->isNotEmpty())
                            <div class="mb-2">
                                <strong>Tags:</strong>
                                @foreach($note->tags as $tag)
                                    <a href="{{ route('notes.byTag', $tag->id) }}" class="badge bg-secondary">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        @endif

                        <a href="{{ route('notes.edit', $note) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('notes.destroy', $note) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif

        @isset($selected_tag)
            <a href="{{ route('notes.index') }}" class="btn btn-secondary mt-3">Back to All Notes</a>
        @endisset

        <div class="d-flex justify-content-center">
            {{ $notes->appends(['search' => request('search')])->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
