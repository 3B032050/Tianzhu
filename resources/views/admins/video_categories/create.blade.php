@extends('admins.layouts.master')

@section('page-title', 'Create article')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">影音類別</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">新增影音類別</li>
        </ol>
        @include('admins.layouts.shared.errors')
        <form action="{{ route('admins.video_categories.store') }}" method="POST" role="form" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="category_name" class="form-label">影音類別名稱</label>
                <input id="category_name" name="category_name" type="text" class="form-control" value="{{ old('category_name') }}" required>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary btn-sm">儲存</button>
            </div>
        </form>
    </div>
@endsection
