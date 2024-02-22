@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
<div class="container-fluid px-4">
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.curricula.index') }}" class="custom-link"><i class="fa fa-home"></i>居士學佛</a> &gt;
            編輯課程
        </p>
    </div>
    <h1 class="mt-4">課程管理管理</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">編輯課程</li>
    </ol>
    @include('admins.layouts.shared.errors')
    <form action="{{ route('admins.curricula.update',$curriculum->id) }}" method="POST" role="form">
        @method('PATCH')
        @csrf

        <div class="form-group">
            <label for="title" class="form-label">課程名稱</label>
            <input id="title" name="title" type="text" class="form-control" value="{{ old('title',$curriculum->title) }}" placeholder="請輸入姓名">
        </div>
        <div class="form-group">
            <label for="curriculum_category">課程類別</label>
            <select name="curriculum_category" id="curriculum_category" class="form-select">
                @foreach($curriculum_categories as $curriculumCategory)
                    @if($curriculumCategory->parent_id == 0)
                        <option value="{{ $curriculumCategory->id }}"  {{ ($curriculumCategory->id == $curriculum->curriculum_category_id) ? 'selected' : '' }}>{{ $curriculumCategory->name }}</option>
                        @foreach($curriculum_categories as $subCategory)
                            @if($subCategory->parent_id == $curriculumCategory->id)
                                <option value="{{ $subCategory->id }}"  {{ ($subCategory->id == $curriculum->curriculum_category_id) ? 'selected' : '' }}>&nbsp&nbsp- {{ $subCategory->name }}</option>
                                @foreach($curriculum_categories as $thirdCategory)
                                    @if($thirdCategory->parent_id == $subCategory->id)
                                        <option value="{{ $thirdCategory->id }}"  {{ ($thirdCategory->id == $curriculum->curriculum_category_id) ? 'selected' : '' }}>&nbsp&nbsp&nbsp-- {{ $thirdCategory->name }}</option>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="curriculum_methods">方法</label>
            <select name="curriculum_methods[]" id="curriculum_methods" class="form-select" multiple>
                @foreach($curriculum_methods as $method)
                    <option value="{{ $method->id }}" {{ (in_array($method->id, $selectedMethods)) ? 'selected' : '' }}>
                        {{ $method->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="curriculum_objectives">目標</label>
            <select name="curriculum_objectives[]" id="curriculum_objectives" class="form-select" multiple>
                @foreach($curriculum_objectives as $objective)
                    <option value="{{ $objective->id }}" {{ (in_array($objective->id, $selectedObjectives)) ? 'selected' : '' }}>
                        {{ $objective->description }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="content" class="form-label">內容</label>
            <textarea id="editor" name="content" class="form-control">{{ old('content',$curriculum->content)}}</textarea>
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
