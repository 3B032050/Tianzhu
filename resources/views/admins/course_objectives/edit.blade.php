@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">編輯課程目標</h1>
    @include('admins.layouts.shared.errors')
    <form action="{{ route('admins.course_objectives.update',$courseObjective->id) }}" method="POST" role="form">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="description" class="form-label">課程目標</label>
            <input id="description" name="description" type="text" class="form-control" value="{{ old('description',$courseObjective->description) }}" placeholder="請輸入課程目標">
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-sm">儲存</button>
        </div>
    </form>
</div>
@endsection
