@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">管理員層級管理</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">編輯管理員層級</li>
    </ol>
    <form action="{{ route('admins.admins.update',$admin->id) }}" method="POST" role="form">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="position" class="form-label">職級</label>
            <select id="position" name="position" class="form-control">
                <option value=0>使用者</option>
                <option value=3>一般管理員</option>
                <option value=2>高階管理員</option>
            </select>
        </div>
        <div class="form-group">
            <label for="account" class="form-label">帳號</label>
            <input id="account" name="account" type="text" class="form-control" value="{{ old('account',$user->account) }}" readonly>
        </div>
        <div class="form-group">
            <label for="name" class="form-label">姓名</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name',$user->name) }}"readonly>
        </div>
        <div class="form-group">
            <label for="phone" class="form-label">電話</label>
            <input id="phone" name="phone" type="text" class="form-control" value="{{ old('phone',$user->phone) }}"readonly>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-sm">儲存</button>
        </div>
    </form>
</div>
@endsection
