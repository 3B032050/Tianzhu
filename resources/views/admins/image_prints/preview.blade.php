@extends('admins.layouts.master')

@section('page-title', '預覽圖片')

@section('page-content')
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.image_prints.index') }}" class="custom-link"><i class="fa fa-home"></i>影印</a> &gt;
                <a href="{{ route('admins.image_prints.review', $imagePrint->id) }}" class="custom-link">{{$imagePrint->name}}牌位審核</a> &gt;
                預覽圖片
            </p>
        </div>
        <h1 class="mt-4">預覽圖片</h1>
        <form id="downloadForm" action="{{ route('admins.image_prints.download') }}" method="GET">
            @csrf
            @foreach($images as $image)
                <input type="hidden" name="images[]" value="{{ $image }}">
            @endforeach
            <button type="submit" class="btn btn-primary">下載 PDF</button>
        </form>
        <div class="row">
            @foreach($images as $index => $image)
                @if($index % 2 == 0)
                    <div class="col-md-6 mb-4">
                        <img src="{{ $image }}" class="img-fluid" alt="Preview Image">
                    </div>
                @else
                    <div class="col-md-6 mb-4">
                        <img src="{{ $image }}" class="img-fluid" alt="Preview Image">
                    </div>
                    <div class="w-100"></div>
                    <hr style="border-top: 1px solid #ccc; margin: 20px 0;">
                @endif
            @endforeach
        </div>
    </div>
@endsection

