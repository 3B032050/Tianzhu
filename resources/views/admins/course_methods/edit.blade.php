@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">編輯課程方法</h1>
    @include('admins.layouts.shared.errors')
    <form action="{{ route('admins.course_methods.update',$courseMethod->id) }}" method="POST" role="form">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">課程方法</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name',$courseMethod->name) }}" placeholder="請輸入課程方法">
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-sm">儲存</button>
        </div>
    </form>
</div>
@endsection
