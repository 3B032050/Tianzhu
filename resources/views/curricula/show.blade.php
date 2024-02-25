@extends('layouts.master')

@section('title','天筑精舍')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            <a href="{{ route('curricula.index') }}" class="custom-link">居士學佛</a> &gt;
            {{ $selectedCategory->name }} >
            {{ $curriculum->title }}
        </p>
    </div>
@endsection

@section('content')
    <section id="location">
        <div class="wrapper mx-auto" style="text-align:center;">
            <div class="card" style="width: 60rem; margin: auto;">
                <h5 class="card-title">{{ $curriculum->title }}</h5>
                <div class="card-body text-start">
                    授課方式<br>
                    @foreach($curriculum->methods as $index => $method)
                        {{ ($index+1) }}
                        {{ $method->name }}<br><br>
                    @endforeach
                    授課目標<br>
                    @foreach($curriculum->objectives as $index => $objective)
                        {{ ($index+1) }}
                        {{ $objective->description }}<br>
                    @endforeach
                    <hr>
                    <p class="card-text">{!! $curriculum->content !!}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
