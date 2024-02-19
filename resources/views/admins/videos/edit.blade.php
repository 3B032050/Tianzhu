@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">法音流佈</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">編輯影音</li>
        </ol>
        @include('admins.layouts.shared.errors')
        <form action="{{ route('admins.videos.update',['video' => $video->id]) }}" method="POST" role="form" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="video_category_id" class="form-label">選擇影音類別</label>
                <select id="video_category_id" name="video_category_id" class="form-control">
                    @foreach($video_categories as $video_category)
                        <option value="{{ $video_category->id }}" {{ $video->video_category_id == $video_category->id ? 'selected' : '' }}>
                            {{$video_category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="video_url" class="form-label">影音連結</label>
                <input id="video_url" name="video_url" type="url" class="form-control" value="{{ old('video_url',$video->video_url) }}" >
            </div>

            <div class="form-group">
                <label for="video_title" class="form-label">影音標題</label>
                <input id="video_title" name="video_title" type="text" class="form-control" value="{{ old('video_title',$video->video_title) }}" >

            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary btn-sm">儲存</button>
            </div>
        </form>
    </div>
@endsection
