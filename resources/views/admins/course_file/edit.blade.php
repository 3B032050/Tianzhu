@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.course_file.index') }}" class="custom-link"><i class="fa fa-home"></i>課程講義</a> &gt;
                編輯課程講義
            </p>
        </div>
        <h1 class="mt-4">課程講義</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">編輯課程講義</li>
        </ol>
        @include('admins.layouts.shared.errors')
        <form action="{{ route('admins.course_file.update',['coursefile' => $coursefile->id]) }}" method="POST" role="form" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="course_file_category_id">課程講義類別</label>
                <select name="course_file_category_id" id="course_file_category_id" class="form-select" >
                    @foreach($course_file_categories as $course_file_category)
                        <option value="{{ $course_file_category->id }}" {{ $coursefile->video_category_id == $course_file_category->id ? 'selected' : '' }}>
                            {{$course_file_category->course_file_category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title" class="form-label">課程名稱</label>
                <input id="title" name="title" type="text" class="form-control" value="{{ old('title',$coursefile->title) }}" >
            </div>

            <div class="form-group">
                <label for="file" class="form-label">課程講義</label>
                <input id="file" name="file" type="file" class="form-control" >
                @if ($coursefile->file)
                    <p class="mt-2">目前檔案: {{ $coursefile->file }}</p>
                @endif
            </div>


            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary btn-sm">儲存</button>
            </div>
        </form>
    </div>
@endsection
