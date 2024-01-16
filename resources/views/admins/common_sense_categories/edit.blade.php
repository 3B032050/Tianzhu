@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.common_senses.index') }}" class="custom-link"><i class="fa fa-home"></i>佛門小常識</a> &gt;
            <a href="{{ route('admins.common_sense_categories.index') }}" class="custom-link">小常識類別</a> &gt;
            編輯 - {{ $commonSense->title }}
        </p>
    </div>
    @include('admins.layouts.shared.errors')
    <form action="{{ route('admins.common_senses.update',$commonSense->id) }}" method="POST" role="form">
        @method('PATCH')
        @csrf

        <div class="form-group">
            <label for="title" class="form-label">標題</label>
            <input id="title" name="title" type="text" class="form-control" value="{{ old('title',$commonSense->title) }}" placeholder="請輸入標題">
        </div>

        <div class="form-group">
            <label for="common_sense_categories">類別</label>
            <select name="common_sense_categories" id="common_sense_categories" class="form-select">
                @foreach($common_sense_categories as $category)
                    <option value="{{ $category->id }}" {{ ($category->id == $commonSense->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="content" class="form-label">內容</label>
            <textarea id="editor" name="content" class="form-control">{{ old('content',$commonSense->content)}}</textarea>
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
