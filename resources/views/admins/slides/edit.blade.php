@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.slides.index') }}" class="custom-link"><i class="fa fa-home"></i>幻燈片管理</a> &gt;
                編輯幻燈片
            </p>
        </div>
        <h1 class="mt-4">幻燈片管理</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">編輯幻燈片</li>
        </ol>
        <form action="{{ route('admins.slides.update', $slide->id) }}" method="POST" role="form" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="title" class="form-label">圖片標題</label>
                <input id="title" name="title" type="text" class="form-control" value="{{ old('title', $slide->title) }}">
            </div>
            <div class="form-group">
                <label for="image_path" class="form-label">書籍圖片</label>
                <input id="image_path" name="image_path" type="file" class="form-control" value="{{ old('image_url',$slide->image_path ) }}" placeholder="請選擇商品圖片" onchange="previewImage(this);">
                <img id="image-preview" src="{{ $slide->image_path ? asset('storage/slides/' . $slide->image_path) : '#' }}" alt="圖片預覽" style="width:200px; height:200px; display: {{ $slide->image_path ? 'block' : 'none' }}" >
            </div>
            <div class="form-group">
                <label for="status" class="form-label">狀態</label>
                <select id="status" name="status" class="form-control">
                    <option value="0" {{ (!$slide->status) ? 'selected' : "" }}>顯示</option>
                    <option value="1" {{ ($slide->status) ? 'selected' : "" }}>不顯示</option>
                </select>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <div class="me-4">
                    <button type="submit" name="status" value="1" class="btn btn-primary btn-sm">暫存幻燈片</button>
                </div>
                <div>
                    <button type="submit" name="status" value="0" class="btn btn-primary btn-sm">立即發佈</button>
                </div>
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
