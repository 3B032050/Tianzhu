@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.curricula.index') }}" class="custom-link"><i class="fa fa-home"></i>僧伽教育</a> &gt;
            <a href="{{ route('admins.curriculum_objectives.index') }}" class="custom-link">課程目標</a> &gt;
            編輯 - {{ $curriculumObjective->description }}
        </p>
    </div>
    @include('admins.layouts.shared.errors')
    <form action="{{ route('admins.curriculum_objectives.update',$curriculumObjective->id) }}" method="POST" role="form">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="description" class="form-label">課程目標</label>
            <input id="description" name="description" type="text" class="form-control" value="{{ old('description',$curriculumObjective->description) }}" placeholder="請輸入課程目標">
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-sm">儲存</button>
        </div>
    </form>
</div>
@endsection
