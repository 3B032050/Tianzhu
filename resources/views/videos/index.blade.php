@extends('layouts.master')

@section('title','法音流佈')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            法音流佈
        </p>
    </div>
@endsection

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2>法音流佈</h2>
                <div class="container px-4 px-lg-5 mt-2 mb-4">
                    <form action="{{ route('videos.search') }}" method="GET" class="d-flex">
                        <select name="category" class="form-select me-2" aria-label="請選擇用標題或類別進行搜尋">
                            <option value="title">標題</option>
                            <option value="category">類別</option>
                        </select>
                        <input type="text" name="query" class="form-control me-2" placeholder="請輸入搜尋內容..">
                        <button type="submit" class="btn btn-outline-dark">搜尋</button>
                    </form>
                </div>
                @if (request()->has('query'))
                    <div class="container px-4 px-lg-5 mt-2 mb-4">
                        查找「{{ request('query') }}」
                        <a class="btn btn-success btn-sm" href="{{ route('admins.course_file.search') }}">取消搜尋</a>
                    </div>
                @endif
            </div>
            {{-- Display all posts --}}
            @if(count($videos) > 0)
                    <div class="row">
                        @foreach ($videos as $video)
                            <div class="col-md-4 mb-4">
                                <div>
                                    <iframe width="100%" height="200" src="https://www.youtube.com/embed/{{ $video->video_id }}" frameborder="0" allowfullscreen></iframe>
                                    <h4>影片標題：{{ $video->video_title }}</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
            @else
                <div align="center"><p>無</p></div>
            @endif
        </div>
    </section>
@endsection
