@extends('courses.layouts.master')

@section('title','居士學佛')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            <a href="{{ route('curricula.index') }}" class="custom-link">居士學佛</a> >
            @if (request()->has('query'))
                查找「{{ request('query') }}」
                <a class="btn btn-success btn-sm" href="{{ route('curricula.index') }}">取消搜尋</a>
            @endif
        </p>
    </div>
@endsection

@section('content')
    <div class="container px-4 px-lg-5 mt-2 mb-4">
        <form action="{{ route('curricula.search') }}" method="GET" class="d-flex">
            <input type="text" name="query" class="form-control me-2" placeholder="關鍵字搜尋...">
            <button type="submit" class="btn btn-outline-dark">搜尋</button>
        </form>
    </div>
    <section class="py-5">
        <div class="container">
            @if(count($selectedCurricula) > 0)
                @foreach($selectedCurricula as $curriculum)
                <div class="accordion" id="coursesAccordion">
                    <div class="card-body">
                        <h4>
                        <a href="{{ route('curricula.show', $curriculum->id) }}">{{ $curriculum->title }}</a>
                        </h4>
                        <hr>
                    </div>
                </div>
                @endforeach
            @else
                <div align="center"><p>無課程</p></div>
            @endif
        </div>
    </section>


    <style>
        .title-link {
            text-decoration: none;
            color: black;
        }

        a {
            text-decoration:none;
        }
    </style>
@endsection
