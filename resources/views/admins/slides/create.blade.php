@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">新增幻燈片</h1>
        <form action="{{ route('admins.slides.store') }}" method="POST" role="form" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="title" class="form-label">標題</label>
                <input id="title" name="title" type="text" class="form-control" placeholder="請輸入標題">
            </div>
            <div class="form-group">
                <label for="image_path" class="form-label">圖片</label>
                <input id="image_path" name="image_path" type="file" class="form-control" placeholder="請選擇圖片" onchange="previewImage(this);">
                <img id="image-preview" src="#" alt="圖片預覽" style="display: none; width:200px; height:200px;" >
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary btn-sm">儲存</button>
            </div>
        </form>
    </div>
@endsection

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
