@extends('admins.layouts.master')

@section('page-title', 'Create article')

@section('page-content')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.common_senses.index') }}" class="custom-link"><i class="fa fa-home"></i>佛門小常識</a> &gt;
                新增小常識
            </p>
        </div>
        <h1 class="mt-4">佛門小常識管理</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">新增小常識</li>
        </ol>
        @include('admins.layouts.shared.errors')
        <form action="{{ route('admins.common_senses.store') }}" method="POST" role="form">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="title" class="form-label">標題</label>
                <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" placeholder="請輸入標題">
            </div>

            <div class="form-group">
                <label for="common_sense_category">類別</label>
                <select name="common_sense_category" id="common_sense_category" class="form-select">
                    @foreach($common_sense_categories as $common_sense_category)
                        <option value="{{ $common_sense_category->id }}">{{ $common_sense_category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="content" class="form-label">內容</label>
                <textarea id="editor" name="content" class="form-control">{{ old('content')}}</textarea>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <div class="me-4">
                    <button type="submit" name="status" value="0" class="btn btn-primary btn-sm">暫存小常識</button>
                </div>
                <div>
                    <button type="submit" name="status" value="1" class="btn btn-primary btn-sm">立即發佈</button>
                </div>
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
