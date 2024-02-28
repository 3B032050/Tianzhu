@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.course_file.index') }}" class="custom-link"><i class="fa fa-home"></i>課程講義</a> &gt;
                <a href="{{ route('admins.course_file_categories.index') }}" class="custom-link">課程講義類別</a> &gt;
                編輯課程講義類別
            </p>
        </div>
        <h1 class="mt-4">課程講義類別</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">編輯課程講義類別</li>
        </ol>
        @include('admins.layouts.shared.errors')
        <form action="{{ route('admins.course_file_categories.update',['course_file_category' => $course_file_category->id]) }}" method="POST" role="form" enctype="multipart/form-data">
            @method('PATCH')
            @csrf

            <div class="form-group">
                <label for="course_file_category_name" class="form-label">課程講義類別</label>
                <input id="course_file_category_name" name="course_file_category_name" type="text" class="form-control" value="{{ old('course_file_category_name',$course_file_category->course_file_category_name) }}" >
            </div>


            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary btn-sm">儲存</button>
            </div>
        </form>
    </div>
@endsection
