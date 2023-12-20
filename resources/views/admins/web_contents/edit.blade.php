@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">網頁內容編輯</h1>
{{--    @include('admins.layouts.shared.errors')--}}
    <form action="{{ route('admins.web_contents.update',$web_hierarchy->web_id) }}" method="POST" role="form" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="title" class="form-label">標題</label>
            <input id="title" name="title" type="text" class="form-control" value="{{ old('title',$web_hierarchy->title) }}" readonly>
        </div>
        <div class="form-group">
            <label for="content" class="form-label">內容</label>
            <textarea id="editor" name="content" class="form-control">{!! old('content', $web_content->content) !!}</textarea>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-sm">儲存</button>
        </div>
    </form>
</div>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ),{
            ckfinder: {
                uploadUrl: '{{route('admins.web_contents.upload').'?_token='.csrf_token()}}',
            }
        })
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
