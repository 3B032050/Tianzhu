@extends('admins.layouts.master')

@section('page-title', 'Create article')

@section('page-content')
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.course_file.index') }}" class="custom-link"><i class="fa fa-home"></i>課程講義</a> &gt;
                新增課程講義
            </p>
        </div>
        <h1 class="mt-4">課程講義</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">新增講義</li>
        </ol>
        @include('admins.layouts.shared.errors')
        <form action="{{ route('admins.course_file.store') }}" method="POST" role="form" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="course_file_category_id">課程講義類別</label>
                <select name="course_file_category_id" id="course_file_category_id" class="form-select" >
                    @foreach($course_file_categories as $course_file_category)
                        <option value="{{ $course_file_category->id }}">{{ $course_file_category->course_file_category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title" class="form-label">課程名稱</label>
                <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="file">課程檔案</label>
                <input id="file" name="file" type="file" class="form-control" value="{{ old('file') }}" required>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <div class="me-4">
                    <button type="submit" name="status" value="0" class="btn btn-primary btn-sm">暫存講義</button>
                </div>
                <div>
                    <button type="submit" name="status" value="1" class="btn btn-primary btn-sm">立即發佈</button>
                </div>
            </div>
        </form>
    </div>
@endsection
