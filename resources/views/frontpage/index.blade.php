@extends('layouts.front_layout')

@section('content')
    <h2>នេះគឺជា Home Page ថ្មី</h2>

    <a href="{{ route('page.home') }}"><h3>នេះគឺជាទំព័រ Blog</h3"></a>
    <a href="{{ url('/homepage')}}"><h3>នេះគឺជាទំព័រ Blog</h3"></a>
@endsection

