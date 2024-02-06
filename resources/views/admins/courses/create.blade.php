@extends('admins.layouts.master')

@section('page-title', 'Create article')

@section('page-content')
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.courses.index') }}" class="custom-link"><i class="fa fa-home"></i>僧伽教育</a> &gt;
                新增課程
            </p>
        </div>
        @include('admins.layouts.shared.errors')
        <form action="{{ route('admins.courses.store') }}" method="POST" role="form">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="title" class="form-label">課程名稱</label>
                <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" placeholder="請輸入姓名">
            </div>

            <div class="form-group">
                <label for="method" class="form-label">類別</label>
                <input id="method" name="method" type="text" class="form-control" value="{{ old('method') }}" placeholder="非必填">
            </div>

            <div class="form-group">
                <label for="course_category">課程分階</label>
                <select name="course_category" id="course_category" class="form-select">
                    @foreach($course_categories as $course_category)
                        <option value="{{ $course_category->id }}">{{ $course_category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="course_methods">方法</label>
                <select name="course_methods[]" id="course_methods" class="form-select" size="{{ count($course_methods) }}" multiple>
                    @foreach($course_methods as $course_method)
                        <option value="{{ $course_method->id }}">{{ $course_method->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="course_objectives">目標</label>
                <select name="course_objectives[]" id="course_objectives" class="form-select" size="{{ count($course_objectives) }}" multiple>
                    @foreach($course_objectives as $course_objective)
                        <option value="{{ $course_objective->id }}">{{ $course_objective->description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="time" class="form-label">時間</label>
                <input id="time" name="time" type="text" class="form-control" value="{{ old('time') }}" placeholder="非必填">
            </div>
            <div class="form-group">
                <label for="note" class="form-label">備註</label>
                <input id="note" name="note" type="text" class="form-control" value="{{ old('note') }}" placeholder="非必填">
            </div>
            <div class="form-group">
                <label for="content" class="form-label">內容</label>
                <textarea id="editor" name="content" class="form-control">{!! old('content') !!}</textarea>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary btn-sm">儲存</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ),{
                ckfinder: {
                    uploadUrl: '{{route('admins.courses.upload').'?_token='.csrf_token()}}',
                },
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
