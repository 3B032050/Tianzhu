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
