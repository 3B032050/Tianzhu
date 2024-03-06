@extends('admins.layouts.master')

@section('page-title', 'Create article')

@section('page-content')
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.videos.index') }}" class="custom-link"><i class="fa fa-home"></i>法音流佈</a> &gt;
                新增影音
            </p>
        </div>
        <h1 class="mt-4">法音流佈</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">新增影音</li>
        </ol>
        @include('admins.layouts.shared.errors')
        <form action="{{ route('admins.videos.store') }}" method="POST" role="form" enctype="multipart/form-data" onsubmit="return validateForm()">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="video_category_id">影音類別</label>
                <select name="video_category_id" id="video_category_id" class="form-select" >
                    @foreach($video_categories as $video_category)
                        <option value="{{ $video_category->id }}">{{ $video_category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="video_url" class="form-label">影音連結</label>
                <input id="video_url" name="video_url" type="url" class="form-control" value="{{ old('video_url') }}" required>
            </div>

{{--            <div class="form-group">--}}
{{--                <label for="video_title">影音標題</label>--}}
{{--                <input id="video_title" name="video_title" type="text" class="form-control" value="{{ old('video_title') }}" >--}}
{{--            </div>--}}
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary btn-sm">儲存</button>
            </div>
        </form>
        <script>
            function validateForm() {
                var videoUrlInput = document.getElementById('video_url');
                var videoUrlRegex = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/;

                if (!videoUrlRegex.test(videoUrlInput.value)) {
                    alert('請輸入有效的 YouTube 連接！');
                    return false; // 阻止表單連接
                }

                return true; // 允許提交表表單
            }
        </script>
    </div>
@endsection
