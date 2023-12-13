@extends('layouts.master')

@section('title','天筑精舍')

@section('content')
    <section id="location mx-auto">
        <div class="wrapper" style="text-align:center">
            {!! $web_content->content !!}
            <div class="mx-auto">
            <img  src="{{ asset( 'storage/web_images/' . $web_content->image_url) }}" height="600px" width="600px">
            </div>
        </div>
    </section>
@endsection
