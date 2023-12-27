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
    <div class="container px-4 px-lg-5 mt-2 mb-4">
        <form action="{{ route('admins.users.search') }}" method="GET" class="d-flex">
            <input type="text" name="query" class="form-control me-2" placeholder="帳號搜尋...">
            <button type="submit" class="btn btn-outline-dark">搜尋</button>
        </form>
    </div>
    @if (request()->has('query'))
        <div class="container px-4 px-lg-5 mt-2 mb-4">
            查找「{{ request('query') }}」
        </div>
    @endif
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
            <th scope="col" style="text-align:left">權限</th>
            <th scope="col" style="text-align:center">修改</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $index => $user)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>
                <td>{{ $user->account }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->sex }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->birthday }}</td>
                <td>{{ $user->phone }}</td>
                @if ($user->isadmin())
                    <td>
                        @if($user->admin->position == 1)
                            <div style="color:#FF0000;">
                                超級管理員
                            </div>
                        @elseif($user->admin->position == 2)
                            <div style="color:#00FF00;">
                                高階管理員
                            </div>
                        @else
                            <div style="color:#0900FF;">
                                一般管理員
                            </div>
                        @endif

                    </td>
                @else
                    <td>一般會員</td>
                @endif
                <td style="text-align:center">
                    <a href="{{ route('admins.users.edit',$user->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm" action="{{ route('admins.users.destroy',$user->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete()">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete()
                    {
                        if (confirm("確定要刪除使用者{{ $user->name }}嗎？")) {
                            document.getElementById('deleteForm').submit();
                        }
                    }
                </script>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
