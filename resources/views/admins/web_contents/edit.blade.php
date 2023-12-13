@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
<div class="container-fluid px-4">
    <h1 class="mt-4">網頁內容管理</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">編輯網頁內容</li>
    </ol>
{{--    @include('admins.layouts.shared.errors')--}}
    <form action="{{ route('admins.web_contents.update',$web_hierarchy->id) }}" method="POST" role="form">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="title" class="form-label">標題</label>
            <input id="title" name="title" type="text" class="form-control" value="{{ old('title',$web_hierarchy->title) }}" readonly>
        </div>
        <div class="form-group">
            <label for="content" class="form-label">內容</label>
            <div id="editor">
                {{ old('content',$web_content->content) }}
{{--                <input id="content" name="content" type="text" class="form-control" value="{{ old('content',$web_content->content) }}">--}}
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-sm">儲存</button>
        </div>
    </form>
</div>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
