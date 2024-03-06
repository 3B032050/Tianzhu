@extends('admins.layouts.master')

@section('page-title', '預覽圖片')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">影印</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="text-align:center">圖片</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($images as $key => $image)
                    <?php
                    // Save the image
                    $fileName = 'output_' . $key . '.jpg';
                    $image->save(storage_path('app/public/image_prints/' . $fileName));
                    // Get the path to the saved image
                    $imagePath = storage_path('app/public/image_prints/' . $fileName);
                    ?>
                    <td style="text-align:center"><img src="{{ asset('storage/image_prints/' . $fileName) }}" alt="Member {{ $key + 1 }}"></td>
                <br>
                {{-- <a href="{{ route('admin.members.download', ['key' => $key]) }}">Download Image</a> --}}
                <br>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
