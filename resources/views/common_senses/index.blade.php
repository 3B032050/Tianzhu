@extends('layouts.master')

@section('title','佛門小常識')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            佛門小常識
        </p>
    </div>
@endsection

@section('content')
    <div class="container px-4 px-lg-5 mt-2 mb-4">
        <form action="{{ route('common_senses.search') }}" method="GET" class="d-flex">
            <input type="text" name="query" class="form-control me-2" placeholder="關鍵字搜尋...">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="search_option" id="search_title" value="title" checked>
                <label class="form-check-label" for="search_title">搜尋標題</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="search_option" id="search_content" value="content">
                <label class="form-check-label" for="search_content">搜尋內文</label>
            </div>
            <button type="submit" class="btn btn-outline-dark">搜尋</button>
        </form>
    </div>
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2>佛門小常識</h2>
            </div>

            {{-- Display all posts --}}
            @if(count($categories) > 0)
                @foreach($categories as $category)
                    <div class="row mb-4">
                        <div class="col-md-6 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('common_senses.show', $category->id) }}">{{ $category->name }}</a></h5>
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

