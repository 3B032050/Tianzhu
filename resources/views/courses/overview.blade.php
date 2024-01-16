@extends('layouts.master')

@section('title','天筑精舍')

@section('content')
    <section id="location">
        <div class="wrapper mx-auto" style="text-align:center;">
            <div class="card" style="width: 60rem; margin: auto;">
                <h5 class="card-title">{{ $courseOverview->title }}</h5>
                <div class="card-body text-start">
                    <p class="card-text">{!! $courseOverview->content !!}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
