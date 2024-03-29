@extends('admins.layouts.master')

@section('page-title', 'Create article')

@section('page-content')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.curricula.index') }}" class="custom-link"><i class="fa fa-home"></i>居士學佛</a> &gt;
                新增課程
            </p>
        </div>
        <h1 class="mt-4">課程管理</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">新增課程</li>
        </ol>
        @include('admins.layouts.shared.errors')
        <form action="{{ route('admins.curricula.store') }}" method="POST" role="form">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="title" class="form-label">課程名稱</label>
                <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" placeholder="請輸入名稱">
            </div>
            <div class="form-group">
                <label for="curriculum_category">課程類別</label>
                <select name="curriculum_category" id="curriculum_category" class="form-select">
                    <option value="">請選擇課程類別</option>
                    @foreach($curriculum_categories as $curriculumCategory)
                        @if($curriculumCategory->parent_id == 0)
                            <option value="{{ $curriculumCategory->id }}">{{ $curriculumCategory->name }}</option>
                            @foreach($curriculum_categories as $subCategory)
                                @if($subCategory->parent_id == $curriculumCategory->id)
                                    <option value="{{ $subCategory->id }}">&nbsp&nbsp- {{ $subCategory->name }}</option>
                                    @foreach($curriculum_categories as $thirdCategory)
                                        @if($thirdCategory->parent_id == $subCategory->id)
                                            <option value="{{ $thirdCategory->id }}">&nbsp&nbsp&nbsp-- {{ $thirdCategory->name }}</option>
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
                @foreach($curriculum_methods as $curriculum_method)
                    <div class="form-check">
                        <input type="checkbox" name="curriculum_methods[]" id="curriculum_method_{{ $curriculum_method->id }}" value="{{ $curriculum_method->id }}" class="form-check-input">
                        <label for="curriculum_method_{{ $curriculum_method->id }}" class="form-check-label">{{ $curriculum_method->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="curriculum_objectives">目標</label>
                @foreach($curriculum_objectives as $curriculum_objective)
                    <div class="form-check">
                        <input type="checkbox" name="curriculum_objectives[]" id="curriculum_objective_{{ $curriculum_objective->id }}" value="{{ $curriculum_objective->id }}" class="form-check-input">
                        <label for="curriculum_objective_{{ $curriculum_objective->id }}" class="form-check-label">{{ $curriculum_objective->description }}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="content" class="form-label">內容</label>
                <textarea id="editor" name="content" class="form-control">{{ old('content')}}</textarea>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <div class="me-4">
                    <button type="submit" name="status" value="0" class="btn btn-primary btn-sm">暫存課程</button>
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
