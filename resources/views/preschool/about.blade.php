@extends('layouts.preschool_layout')

@section('title', 'About Us')

@section('page_header')
<!-- Page Header End -->
    <div class="container-xxl py-5 page-header position-relative mb-5">
        <div class="container py-5">
            <h1 class="display-2 text-white animated slideInDown mb-4">About Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </div>
<!-- Page Header End -->
@endsection

@section('content')

        <!-- About Start -->
        @include('preschool.pages.about')
        <!-- About End -->


       {{-- become a teacher --}}
        @include('preschool.pages.call_action')

        <!-- Team Start -->
        @include('preschool.pages.team')
        <!-- Team End -->




@endsection



