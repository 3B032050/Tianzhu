@extends('layouts.master')

@section('title','天筑精舍')

@section('content')
    <section id="location">
        <div class="wrapper mx-auto" style="text-align:center">
            <figure class="media">
{{--            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1076.290597413383!2d121.27883451733794!3d24.857167528160875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3468176912c5eaa7%3A0x46b0f53d5ae5cb0!2z5aSp562R57K-6IiN!5e0!3m2!1szh-TW!2stw!4v1703663537832!5m2!1szh-TW!2stw" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>--}}
            {!! $web_content->content !!}
            </figure>
        </div>
    </section>
@endsection
