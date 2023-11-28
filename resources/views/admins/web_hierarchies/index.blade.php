@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">網頁階層管理</h1>
{{--    <ol class="breadcrumb mb-4">--}}
{{--        <li class="breadcrumb-item active">用戶一覽表</li>--}}
{{--    </ol>--}}
{{--    <div class="alert alert-success alert-dismissible" role="alert" id="liveAlert">--}}
{{--        <strong>完成！</strong> 成功儲存用戶--}}
{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--    </div>--}}
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.posts.create') }}">新增用戶</a>
    </div>
    <table class="table">
        <thead>
{{--        <tr>--}}
{{--            <th scope="col">#</th>--}}
{{--            <th scope="col" style="text-align:left">使用者id</th>--}}
{{--            <th scope="col" style="text-align:left">姓名</th>--}}
{{--            <th scope="col" style="text-align:left">階級</th>--}}
{{--            <th scope="col" style="text-align:left">電子信箱</th>--}}
{{--            <th scope="col" style="text-align:center">修改</th>--}}
{{--            <th scope="col" style="text-align:center">刪除</th>--}}
{{--        </tr>--}}
        </thead>
        <tbody>

        @php
            $controller = App::make('App\Http\Controllers\AdminWebHierarchiesController');
            $controller->web_print($webs);
            @foreach($webs as $web)
            @endforeach
        @endphp
{{--        @foreach($admins as $admin)--}}
{{--            <tr>--}}
{{--                <td style="text-align:left">{{ $admin->id }}</td>--}}
{{--                <td style="text-align:left">{{ $admin->user_id }}</td>--}}
{{--                <td>{{ $admin->name }}</td>--}}
{{--                <td>{{ $admin->position }}--}}
{{--                @if ($admin->position == '1')--}}
{{--                    (一般管理員)--}}
{{--                @elseif ($admin->position == '2')--}}
{{--                    (高階管理員)--}}
{{--                @elseif ($admin->position == '3')--}}
{{--                    (超級管理員)--}}
{{--                @endif--}}
{{--                </td>--}}
{{--                <td>{{ $admin->email }}</td>--}}
{{--                <td style="text-align:center">--}}
{{--                    <a href="{{ route('admins.users.edit',$admin->id) }}" class="btn btn-warning btn-sm">編輯</a>--}}
{{--                </td>--}}
{{--                <td style="text-align:center">--}}
{{--                    <form action="{{ route('admins.users.destroy',$admin->id) }}" method="POST">--}}
{{--                        @method('DELETE')--}}
{{--                        @csrf--}}
{{--                        <button type="submit" class="btn btn-danger btn-sm">刪除</button>--}}
{{--                    </form>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
        </tbody>
    </table>
</div>
@endsection
