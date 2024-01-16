@extends('admins.layouts.master')

@section('page-title', 'Create article')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">課程講義</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">新增講義</li>
        </ol>
        @include('admins.layouts.shared.errors')
        <form action="{{ route('admins.course_file.store') }}" method="POST" role="form" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="title" class="form-label">課程名稱</label>
                <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="file">課程檔案</label>
                <input id="file" name="file" type="file" class="form-control" value="{{ old('file') }}" required>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary btn-sm">儲存</button>
            </div>
        </form>
    </div>
@endsection
