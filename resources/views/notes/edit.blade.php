@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Note</h1>
        <form action="{{ route('notes.update', $note) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $note->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ $note->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <select name="tags[]" id="tags" class="form-control" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ $note->tags->contains($tag) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Note</button>
        </form>
    </div>
@endsection
