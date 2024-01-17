@extends('layouts.master')

@section('title','佛門小常識')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2>佛門小常識</h2>
            </div>

            {{-- Display all posts --}}
            @if(count($categories) > 0)
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-md-6 mb-4 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('common_senses.show',$category->id) }}">{{ $category->name }}</a></h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div align="center"><p>無</p></div>
            @endif
        </div>
    </section>

@endsection
