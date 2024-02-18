@extends('layouts.master')

@section('title','課程講義')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            <a href="{{ route('course_file.index') }}" class="custom-link">課程講義</a> >
            {{ $selectcoursefilecategory->course_file_category_name }}
        </p>
    </div>
@endsection

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2>講義類別: {{ $selectcoursefilecategory->course_file_category_name }}</h2>
            </div>

            {{-- Display all posts --}}
            @if(count($coursefiles) > 0)
                    @foreach($coursefiles as $coursefile)
                        <div class="col-md-6 mb-4 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">講義主題: {{ $coursefile->title }}</h5>
                                    <p class="card-text">
                                        <a href="{{ route('course_file.download', ['id' => $coursefile->id, 'course_file' => $coursefile->file]) }}">
                                            下載文件：{{ $coursefile->file}}
                                        </a>
                                    </p>
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
