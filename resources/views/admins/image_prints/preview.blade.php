@extends('admins.layouts.master')

@section('page-title', '預覽圖片')

@section('content')
    <h1>Preview Members</h1>

    @foreach ($images as $key => $image)
            <?php
            $imageData = $image
                ->encode('jpg',75) // 指定圖片格式和品質
                ->data();
            ?>
        <img src="{{ $imageData }}" alt="Member {{$key+1}}">
        <br>
        <a href="{{ route('admin.members.download', ['key' => $key]) }}">Download Image</a>
        <br>
    @endforeach

{{--    <form action="{{ route('admin.members.download') }}" method="post">--}}
{{--        @csrf--}}
{{--        <button type="submit">Download All Images</button>--}}
{{--    </form>--}}
@endsection
