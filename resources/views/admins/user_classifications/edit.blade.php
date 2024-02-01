@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.users.index') }}" class="custom-link"><i class="fa fa-home"></i>用戶資料</a> &gt;
            <a href="{{ route('admins.user_classifications.index') }}" class="custom-link"><i class="fa fa-home"></i>用戶分類</a> &gt;
            編輯 - {{ $userClassification->name }}
        </p>
    </div>
    @include('admins.layouts.shared.errors')
    <form action="{{ route('admins.user_classifications.update',$userClassification->id) }}" method="POST" role="form">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">用戶分類名稱</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name',$userClassification->name) }}" placeholder="請輸入課程目標">
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-sm">儲存</button>
        </div>
    </form>
</div>
@endsection
