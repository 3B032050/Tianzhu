@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">網頁內容管理</h1>
{{--    <div class="d-grid gap-2 d-md-flex justify-content-md-end">--}}
{{--        <a class="btn btn-success btn-sm" href="{{ route('admins.users.create') }}">新增用戶</a>--}}
{{--    </div>--}}
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">網頁id</th>
            <th scope="col" style="text-align:left">父階層id</th>
            <th scope="col" style="text-align:left">標題</th>
            <th scope="col" style="text-align:center">修改</th>
{{--            <th scope="col" style="text-align:center">刪除</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($web_hierarchies as $web_hierarchy)
            <tr>
                <td style="text-align:left">{{ $web_hierarchy->id }}</td>
                <td>{{ $web_hierarchy->web_id }}</td>
                <td>{{ $web_hierarchy->parent_id }}</td>
                <td>{{ $web_hierarchy->title }}</td>
                <td style="text-align:center">
                    <a href="{{ route('admins.web_contents.edit',['web_content' => $web_hierarchy->web_id]) }}" class="btn btn-secondary btn-sm">編輯內容</a>
                </td>
{{--                <td style="text-align:center">--}}
{{--                    <form action="{{ route('admins.web_hierarchies.destroy',$web_hierarchy->id) }}" method="POST">--}}
{{--                        @method('DELETE')--}}
{{--                        @csrf--}}
{{--                        <button type="submit" class="btn btn-danger btn-sm">刪除</button>--}}
{{--                    </form>--}}
{{--                </td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
