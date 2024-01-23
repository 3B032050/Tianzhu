@extends('layouts.master')

@section('title','佛門小常識')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            <a href="{{ route('common_senses.index') }}" class="custom-link">佛門小常識</a> >
            {{ $selectedCategory->name }}
        </p>
    </div>
@endsection

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2>{{ $selectedCategory->name }}</h2>
            </div>

            {{-- Display all posts --}}
            @if(count($common_senses) > 0)
                    @foreach($common_senses as $common_sense)
                        <div class="col-md-6 mb-4 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('common_senses.show_content', ['common_sense_id' => $common_sense->id, 'common_sense_category_id' => $selectedCategory->id]) }}">
                                            {{ $common_sense->title }}
                                        </a></h5>
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
