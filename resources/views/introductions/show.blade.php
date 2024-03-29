@extends('layouts.master')

@section('title','天筑精舍')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            {{ $introduction->title }}
        </p>
    </div>
@endsection

@section('content')
    <section id="location">
        <div class="wrapper mx-auto" style="text-align:center;">
            <div class="card" style="width: 60rem; margin: auto;">
                <h5 class="card-title">{{ $introduction->title }}</h5>
                <div class="card-body text-start">
                    <p class="card-text">{!! $introduction->content !!}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
