@extends('layouts.master')

@section('title','活動紀實')

@section('content')
    <section class="py-5">
        <div class="container text-center">
            <h2>活動紀實</h2>
        </div>
        <div>
            @if(count($activities) > 0)
                <div style="max-width: 960px; margin: auto;">
                    @foreach($activities as $activity)
                        <div class="card mb-4">
                            <div class="card-header">
                                <h2 class="mb-0">
                                    <a href="{{ route('activities.show', $activity->id) }}" class="btn btn-link custom-link">
                                        {{ $activity->title }}
                                    </a>
                                </h2>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div align="center"><p>無活動</p></div>
            @endif
        </div>
    </section>
@endsection
