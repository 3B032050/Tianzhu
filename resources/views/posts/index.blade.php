@extends('layouts.master')

@section('title','最新消息')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            最新消息
        </p>
    </div>
@endsection

@section('content')
    <section class="py-5">
    <div class="wrapper mx-auto" style="text-align:center">
        <div class ="table">
            <table class="table"  style="text-align:center">
                <thead>
                <tr>
                    <th scope="col" style="text-align:center">標題</th>
                    <th scope="col" style="text-align:center">日期</th>

                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td style="text-align:center">
                            <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                        </td>
                        <td>{{ $post->announce_date }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </section>
@endsection
