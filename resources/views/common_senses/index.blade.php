@extends('layouts.master')

@section('title','佛門小常識')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            佛門小常識
        </p>
    </div>
@endsection

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2>佛門小常識</h2>
            </div>

            {{-- Display all posts --}}
            @if(count($categories) > 0)
                @foreach($categories as $category)
                    <div class="row mb-4">
                        <div class="col-md-6 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('common_senses.show', $category->id) }}">{{ $category->name }}</a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div align="center"><p>無</p></div>
            @endif
        </div>
    </section>
@endsection
