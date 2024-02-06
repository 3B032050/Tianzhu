@extends('admins.layouts.master')

@section('page-title', 'Create article')

@section('page-content')
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.users.index') }}" class="custom-link"><i class="fa fa-home"></i>用戶資料</a> &gt;
                <a href="{{ route('admins.user_classifications.index') }}" class="custom-link"><i class="fa fa-home"></i>用戶分類</a> &gt;
                新增用戶分類
            </p>
        </div>
        <h1 class="mt-4">新增用戶分類</h1>
        @include('admins.layouts.shared.errors')
        <form action="{{ route('admins.user_classifications.store') }}" method="POST" role="form">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">用戶分類名稱</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}" placeholder="請輸入分類名稱">
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary btn-sm">儲存</button>
            </div>
        </form>
    </div>
@endsection


