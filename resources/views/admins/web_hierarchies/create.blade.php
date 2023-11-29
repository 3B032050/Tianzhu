@extends('admins.layouts.master')

@section('page-title', 'Create article')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">新增子階層，目前階層：{{$web_hierarchy->title}}</h1>
    @include('admins.layouts.shared.errors')
    <form action="{{ route('admins.web_hierarchies.store') }}" method="POST" role="form">
        @method('POST')
        @csrf
        @php
            $controller = App::make('App\Http\Controllers\AdminWebHierarchiesController');
            $web_id = $controller->adding($web_hierarchy->web_id);
        @endphp
        <div class="form-group">
            <label for="web_id" class="form-label">網頁階層</label>
            <input id="web_id" name="web_id" type="text" class="form-control" value="{{ old('web_id',$web_id) }}" readonly>
        </div>
        <div class="form-group">
            <label for="parent_id" class="form-label">父階層</label>
            <input id="parent_id" name="parent_id" type="text" class="form-control" value="{{ old('parent_id',$web_hierarchy->web_id) }}" readonly>
        </div>
        <div class="form-group">
            <label for="title" class="form-label">網頁標題</label>
            <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" placeholder="請輸入網頁標題">
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-sm">儲存</button>
        </div>
    </form>
</div>
@endsection
