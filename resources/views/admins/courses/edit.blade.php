@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">課程管理管理</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">編輯課程</li>
    </ol>
    @include('admins.layouts.shared.errors')
    <form action="{{ route('admins.courses.update',$course->id) }}" method="POST" role="form">
        @method('PATCH')
        @csrf

        <div class="form-group">
            <label for="title" class="form-label">課程名稱</label>
            <input id="title" name="title" type="text" class="form-control" value="{{ old('title',$course->title) }}" placeholder="請輸入姓名">
        </div>

        <div class="form-group">
            <label for="method" class="form-label">類別</label>
            <input id="method" name="method" type="text" class="form-control" value="{{ old('method',$course->method) }}" placeholder="非必填">
        </div>

        <div class="form-group">
            <label for="course_category">課程分階</label>
            <select name="course_category" id="course_category" class="form-select">
                @foreach($course_categories as $category)
                    <option value="{{ $category->id }}" {{ ($category->id == $course->course_category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="course_methods">方法</label>
            <select name="course_methods[]" id="course_methods" class="form-select" size="{{ count($course_methods) }}" multiple>
                @foreach($course_methods as $method)
                    <option value="{{ $method->id }}" {{ (in_array($method->id, $selectedMethods)) ? 'selected' : '' }}>
                        {{ $method->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="course_objectives">目標</label>
            <select name="course_objectives[]" id="course_objectives" class="form-select" size="{{ count($course_objectives) }}" multiple>
                @foreach($course_objectives as $objective)
                    <option value="{{ $objective->id }}" {{ (in_array($objective->id, $selectedObjectives)) ? 'selected' : '' }}>
                        {{ $objective->description }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="time" class="form-label">時間</label>
            <input id="time" name="time" type="text" class="form-control" value="{{ old('time',$course->time) }}" placeholder="非必填">
        </div>
        <div class="form-group">
            <label for="note" class="form-label">備註</label>
            <input id="note" name="note" type="text" class="form-control" value="{{ old('note',$course->note) }}" placeholder="非必填">
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-sm">儲存</button>
        </div>
    </form>
</div>
@endsection
