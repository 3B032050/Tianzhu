@extends('admins.layouts.master')

@section('page-title', 'Create article')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">管理員資料管理</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">新增管理員</li>
    </ol>
    @include('admins.layouts.shared.errors')
    <form action="{{ route('admins.users.store') }}" method="POST" role="form">
        @method('POST')
        @csrf
        <div class="form-group">
            <label for="account" class="form-label">選擇使用者帳號</label>
            <select id="account" name="account" class="form-control" onclick="{{route('admins.admins.create_selected')}}">
            @foreach($users as $user)
                <option value="{{$user->account}}">{{$user->account}}</option>
            @endforeach
            </select>
        </div>
    </form>
</div>
@endsection
