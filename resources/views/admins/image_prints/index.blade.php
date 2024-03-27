@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">影印</h1>
        <div class="row">
            @foreach($imagePrints as $index => $imagePrint)
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header" style="text-align: center;">
                            <strong>{{ $imagePrint->name }}</strong>
                        </div>
                        <div class="card-body" style="text-align: center;">
                            <img src="{{ asset('images/' . $imagePrint->image_url) }}" alt="{{ $imagePrint->name }}" height="450px" width="450px">
                        </div>
                        <div class="card-footer" style="text-align: center;">
                            <a href="{{ route('admins.image_prints.review', $imagePrint->id) }}" class="btn btn-secondary btn-sm">審核</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
