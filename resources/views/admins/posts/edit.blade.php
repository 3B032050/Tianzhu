@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
<div class="container-fluid px-4">
    <h1 class="mt-4">文章管理</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">編輯文章</li>
    </ol>
    @include('admins.layouts.shared.errors')
    <form action="{{ route('admins.posts.update',$post->id) }}" method="POST" role="form" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="title" class="form-label">文章標題</label>
            <input id="title" name="title" type="text" class="form-control"  value="{{ old('title',$post->title) }}">
        </div>
{{--        <div class="form-group">--}}
{{--            <label for="content" class="form-label">文章內容</label>--}}
{{--            <textarea id="content" name="content" class="form-control" rows="10" >{{ old('content',$post->content) }}</textarea>--}}
{{--        </div>--}}
        <div class="form-group">
            <label for="content" class="form-label">內容</label>
            <textarea id="editor" name="content" class="form-control">{{ old('content', $post->content) }}</textarea>
        </div>
        <div class="form-group">
            <label for="is_feature" class="form-label">精選?</label>
            <select id="is_feature" name="is_feature" class="form-control">
                <option value="0" {{(!$post->is_feature)?'selected':""}}>否</option>
                <option value="1" {{($post->is_feature)?'selected':""}}>是</option>
            </select>
        </div>
        <div class="form-group">
            <label for="file" class="form-label">上傳檔案</label>
            <input id="file" name="file" type="file" class="form-control" rows="10" placeholder="附檔">{{ old('file',$post->file) }}</input>
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
