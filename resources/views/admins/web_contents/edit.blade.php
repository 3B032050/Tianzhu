@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
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
            <textarea id="editor" name="content" class="form-control">{{ old('content', $web_content->content) }}</textarea>
        </div>
        <div class="form-group">
            <label for="image_url" class="form-label">圖片</label>
            <input id="image_url" name="image_url" type="file" class="form-control" value="{{ old('image_url') }}" placeholder="請選擇商品圖片" onchange="previewImage(this);">
{{--            #若資料庫內有圖片可預覽；若無則不顯示--}}
            <img id="image-preview" src="{{ $web_content->image_url ? asset('storage/web_images/' . $web_content->image_url) : '#' }}" alt="圖片預覽" style="width:200px; height:200px; display: {{ $web_content->image_url ? 'block' : 'none' }}" >
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-sm">儲存</button>
        </div>
    </form>
</div>
<script>
    function previewImage(input) {
        var preview = document.getElementById('image-preview');
        var file = input.files[0];
        var reader = new FileReader();
        reader.onloadend = function () {
            preview.src = reader.result;
            preview.style.display = 'block';
        }
        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
