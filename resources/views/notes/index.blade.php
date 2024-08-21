@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Notes</h1>
        <a href="{{ route('notes.create') }}" class="btn btn-primary mb-3">Create New Note</a>
        @foreach($notes as $note)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $note->title }}</h5>
                    <p class="card-text">{{ $note->description }}</p>

                    <!-- Display tags -->
                    @if($note->tags->isNotEmpty())
                        <div class="mb-2">
                            <strong>Tags:</strong>
                            @foreach($note->tags as $tag)
                                <span class="badge bg-secondary">{{ $tag->name }}</span>
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
    </div>
@endsection
