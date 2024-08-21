@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Create Tag</h1>

        <form method="POST" action="{{ route('tags.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Tag Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
