@extends('layouts.master')

@section('title','牌位登記')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            牌位登記
        </p>
    </div>
@endsection

@section('content')
    <section class="py-5">
        <div class="container text-center">
            <h2>牌位登記</h2>
            <div class="row">
                <div class="col-md-6 bg-red">
                    <h3>消災牌位 Tablets for blessing</h3>
                    <a class="btn btn-success btn-lg" href="{{ route('tablets.create_blessing')}}">登記</a>
                </div>
                <div class="col-md-6 bg-yellow">
                    <h3>超薦牌位 Tablets for delivering the deceased</h3>
                    <a class="btn btn-success btn-lg" href="{{ route('tablets.select_delivering_the_decreased') }}">登記</a>
                </div>
            </div>
        </div>
    </section>
    <style>
        .bg-red {
            background-color: #FFD7D7; /* 淡紅色 */
        }

        .bg-yellow {
            background-color: #FDFFE4; /* 淡黃色 */
        }
    </style>
@endsection


