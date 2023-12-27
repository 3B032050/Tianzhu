@extends('layouts.master')

@section('title','天筑精舍')

@section('content')
    <section id="location">
        <div class="wrapper mx-auto" style="text-align:center">
            {!! $web_content->content !!}
        </div>
    </section>
@endsection
