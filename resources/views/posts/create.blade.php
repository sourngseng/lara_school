@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <br>
        <label for="content">Content</label>
        <textarea name="content" id="content"></textarea>
        <br>
        <label for="image">Upload</label>
        <input type="file" name="image" id="image">
        <br>
        <button type="submit">Submit</button>
    </form>
@endsection
