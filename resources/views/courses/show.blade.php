@extends('layouts.master')

@section('title','天筑精舍')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            <a href="{{ route('courses.overview') }}" class="custom-link">僧伽教育</a> &gt;
            <a href="{{ route('courses.by_category',$selectedCategory->id) }}" class="custom-link">{{ $selectedCategory->name }}</a> &gt;
            {{ $course->title }}
        </p>
    </div>
@endsection

@section('content')
    <section id="location">
        <div class="wrapper mx-auto" style="text-align:center;">
            <div class="card" style="width: 60rem; margin: auto;">
                <h5 class="card-title">{{ $course->title }}</h5>
                <div class="card-body text-start">
                    <p class="card-text">{!! $course->content !!}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
