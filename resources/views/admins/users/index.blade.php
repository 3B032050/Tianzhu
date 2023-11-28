@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">用戶資料管理</h1>
{{--    <ol class="breadcrumb mb-4">--}}
{{--        <li class="breadcrumb-item active">用戶一覽表</li>--}}
{{--    </ol>--}}
{{--    <div class="alert alert-success alert-dismissible" role="alert" id="liveAlert">--}}
{{--        <strong>完成！</strong> 成功儲存用戶--}}
{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--    </div>--}}
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.users.create') }}">新增用戶</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">帳號</th>
            <th scope="col" style="text-align:left">姓名</th>
            <th scope="col" style="text-align:left">性別</th>
            <th scope="col" style="text-align:left">電子信箱</th>
            <th scope="col" style="text-align:left">生日</th>
            <th scope="col" style="text-align:left">電話</th>
            <th scope="col" style="text-align:center">修改</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td style="text-align:left">{{ $user->id }}</td>
                <td>{{ $user->account }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->sex }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->birthday }}</td>
                <td>{{ $user->phone }}</td>
                <td style="text-align:center">
                    <a href="{{ route('admins.users.edit',$user->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form action="{{ route('admins.users.destroy',$user->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">刪除</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
