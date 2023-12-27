@extends('layouts.master')

@section('title','天筑精舍')

@section('content')
    <section id="location mx-auto">
        <div class="wrapper" style="text-align:center">
            {!! $web_content->content !!}
        </div>
    </section>
@endsection
