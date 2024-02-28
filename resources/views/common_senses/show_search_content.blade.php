@extends('layouts.master')

@section('title','佛門小常識')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            <a href="{{ route('common_senses.index') }}" class="custom-link">佛門小常識</a> >
            {{ $common_sense->title }} >
            內容
        </p>
    </div>
@endsection

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2>標題：{{ $common_sense->title }}</h2>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <figure class="media">
                                {!! $common_sense->content !!}
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
