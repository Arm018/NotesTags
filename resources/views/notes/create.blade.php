@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Note</h1>
        <form action="{{ route('notes.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="tags">Tags</label>
                <select name="tags[]" id="tags" class="form-control" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="new_tag">Add New Tag</label>
                <input type="text" name="new_tag" id="new_tag" class="form-control" placeholder="You can add multiple tags separated by comma">
            </div>
            <button type="submit" class="btn btn-primary">Save Note</button>
        </form>
    </div>
@endsection
