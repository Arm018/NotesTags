@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Tag</h1>

        <form method="POST" action="{{ route('tags.update', $tag->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Tag Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $tag->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
