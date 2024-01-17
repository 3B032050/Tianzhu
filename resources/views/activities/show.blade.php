@extends('layouts.master')

@section('title','活動內容')

@section('content')
    <section id="location">
        <div class="wrapper mx-auto" style="text-align:center;">
            <div class="card" style="width: 60rem; margin: auto;">
                <h5 class="card-title">{{ $activity->title }}</h5>
                <div class="card-body text-start">
                    <p class="card-text">{!! $activity->content !!}</p>
                </div>
            </div>
        </div>
    </section>
@endsection

