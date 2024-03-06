@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">管理員管理</h1>
{{--    <ol class="breadcrumb mb-4">--}}
{{--        <li class="breadcrumb-item active">用戶一覽表</li>--}}
{{--    </ol>--}}
{{--    <div class="alert alert-success alert-dismissible" role="alert" id="liveAlert">--}}
{{--        <strong>完成！</strong> 成功儲存用戶--}}
{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--    </div>--}}
    <a class="btn btn-success btn-sm" href="{{ route('admins.permissions.index') }}">權限管理</a><br><br>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.admins.create') }}">新增管理員</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">管理員id</th>
            <th scope="col" style="text-align:left">姓名</th>
            <th scope="col" style="text-align:left">階級</th>
            <th scope="col" style="text-align:left">電子信箱</th>
            <th scope="col" style="width: 13%; text-align:left">加入的管理員</th>
            <th scope="col" style="text-align:center">修改</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($admins as $index => $admin)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}
                <td style="text-align:left">{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->position }}
                @if ($admin->position == '3')
                    (一般管理員)
                @elseif ($admin->position == '2')
                    (高階管理員)
                @elseif ($admin->position == '1')
                    (超級管理員)
                @endif
                </td>
                <td>{{ $admin->email }}</td>
                <td>
                    @if($admin->lastModifiedByAdmin)
                        {{ $admin->lastModifiedByAdmin->user->name }}
                    @else
                        無
                    @endif
                </td>
                <td style="text-align:center">
                    <a href="{{ route('admins.admins.edit',$admin->user_id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm" action="{{ route('admins.admins.destroy', $admin->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete()">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete()
                    {
                        if (confirm("確定要刪除管理員{{ $admin->name }}嗎？")) {
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
