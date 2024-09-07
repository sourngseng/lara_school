@extends('layouts.front_layout')

@section('content')
    <h2>នេះគឺជាទំព័រ Blog</h2>
    <a href="{{ route('posts.create') }}">Create Post</a>
    <a href="{{ route('page.home') }}"><h3>នេះគឺជាទំព័រ Blog</h3></a>
    <table>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>
                    <img style="width: 50px;" src="{{ asset('images/'.$post->image) }}" alt="{{ $post->title }}">
                </td>
                <td>
                    <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                    <a href="{{ route('posts.destroy', $post->id) }}">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
