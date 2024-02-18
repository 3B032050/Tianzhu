@extends('layouts.master')

@section('title','課程講義')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            課程講義
        </p>
    </div>
@endsection

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2>課程講義</h2>
            </div>

            {{-- Display all posts --}}
            @if(count($course_file_categories) > 0)
                @foreach($course_file_categories as $category)
                    <div class="row mb-4">
                        <div class="col-md-6 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('course_file.show', $category->id) }}">{{ $category->course_file_category_name }}</a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div align="center"><p>無</p></div>
            @endif
        </div>
    </section>
@endsection
