@extends('layouts.master')

@section('title','佛門小常識')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2>標題：{{ $common_sense->title }}</h2>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <figure class="media">
                                {!! $common_sense->content !!}
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
