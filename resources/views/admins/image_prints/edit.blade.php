@extends('admins.layouts.master')

@section('page-title', '編輯圖片')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">圖片管理</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">編輯圖片</li>
        </ol>
        @include('admins.layouts.shared.errors')
        <form action="{{ route('admins.image_prints.update',$imagePrint->id) }}" method="POST" role="form">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">名稱</label>
                <input id="name" name="name" type="text" class="form-control"  value="{{ old('name',$imagePrint->name) }}">
            </div>
            <div class="form-group">
                <label for="image_url" class="form-label">圖片</label>
                <input id="image_url" name="image_url" type="file" class="form-control" value="{{ old('image_url',$imagePrint->image_url ) }}" placeholder="請選擇圖片" onchange="previewImage(this);">
                <img id="image-preview" src="#" alt="圖片預覽" style="display: none; width:200px; height:200px;" >
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
@endsection
