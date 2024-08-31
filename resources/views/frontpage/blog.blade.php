@extends('layouts.front_layout')

@section('content')
    <h2>នេះគឺជាទំព័រ Blog</h2>

    <h3>List all users</h3>
    <a href="{{ route('page.home') }}"><h3>នេះគឺជាទំព័រ Blog</h3></a>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Avatar</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <img style="width: 50px;" src="{{ asset($user->avatar) }}" alt="{{ $user->name }}">
                </td>
            </tr>
        @endforeach
    </table>
@endsection
