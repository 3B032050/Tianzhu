@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.introductions.index') }}" class="custom-link"><i class="fa fa-home"></i>天筑精舍簡介</a> &gt;
            編輯{{ $introduction->title }}
        </p>
    </div>
    @include('admins.layouts.shared.errors')
    <form action="{{ route('admins.introductions.update',$introduction->id) }}" method="POST" role="form">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="title" class="form-label">標題</label>
            <input id="title" name="title" type="text" class="form-control" value="{{ old('title',$introduction->title) }}" readonly>
        </div>
        <div class="form-group">
            <label for="content" class="form-label">內容</label>
            <textarea id="editor" name="content" class="form-control">{!! old('content', $introduction->content) !!}</textarea>
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
                uploadUrl: '{{route('admins.introductions.upload').'?_token='.csrf_token()}}',
            },
        })
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
