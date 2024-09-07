@extends('layouts.preschool_layout')
@section('page_header')
<!-- Page Header End -->
    <div class="container-xxl py-5 page-header position-relative mb-5">
        <div class="container py-5">
            <h1 class="display-2 text-white animated slideInDown mb-4">Classes</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Classes</li>
                </ol>
            </nav>
        </div>
    </div>
<!-- Page Header End -->
@endsection
@section('content')



        <!-- Classes Start -->
        @include('preschool.pages.class_start')
        <!-- Classes End -->


        <!-- Appointment Start -->
        @include('preschool.pages.appointment')
        <!-- Appointment End -->


        <!-- Team Start -->
        @include('preschool.pages.team')
        <!-- Team End -->


        <!-- Testimonial Start -->
        @include('preschool.pages.testimonial')
        <!-- Testimonial End -->

@endsection



