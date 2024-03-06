@extends('admins.layouts.master')

@section('page-title', '新增活動')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.activities.index') }}" class="custom-link"><i class="fa fa-home"></i>活動紀實</a> &gt;
            新增活動
        </p>
    </div>
    @include('admins.layouts.shared.errors')
    <form action="{{ route('admins.activities.store') }}" method="POST" role="form" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="form-group">
            <label for="title" class="form-label">活動名稱</label>
            <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="content" class="form-label">活動內容</label>
            <textarea id="editor" name="content" class="form-control">{!! old('content') !!}</textarea>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-sm">儲存</button>
        </div>
    </form>
</div>

<script src="/node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['bold', 'italic']
            })
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(error => {
                console.error(error.stack);
            });
    });
</script>

@endsection
