@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.posts.index') }}" class="custom-link"><i class="fa fa-home"></i>公告管理</a> &gt;
        </p>
    </div>
    <h1 class="mt-4">公告管理</h1>
    <div class="container px-4 px-lg-5 mt-2 mb-4">
        <form action="{{ route('admins.posts.search') }}" method="GET" class="d-flex">
            <input type="text" name="query" class="form-control me-2" placeholder="請輸入標題..">
            <button type="submit" class="btn btn-outline-dark">搜尋</button>
        </form>
    </div>
    @if (request()->has('query'))
        <div class="container px-4 px-lg-5 mt-2 mb-4">
            查找「{{ request('query') }}」
            <a class="btn btn-success btn-sm" href="{{ route('admins.posts.search') }}">取消搜尋</a>
        </div>
    @endif
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.posts.create') }}">新增公告</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:center">標題</th>
            <th scope="col" style="text-align:center">公告時間</th>
            <th scope="col" style="text-align:left">狀態</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:left">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $index => $post)
            <tr>
                <td style="text-align:left">{{$index+1}}</td>
                <td style="text-align:center">{{$post->title}}</td>
                <td style="text-align:center">{{$post->created_at}}</td>
                @if($post->status=='1')
                    <td style="text-align:center">
                        上架
                    </td>
                @else
                    <td style="text-align:center; color: red;">
                        下架
                    </td>
                @endif
                <td style="text-align:center">
                    <a href="{{ route('admins.posts.edit',$post->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                @if($post->status=='1')
                    <td style="text-align:center">
                        <form action="{{ route('admins.posts.statusoff',$post->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">下架</button>
                        </form>
                    </td>
                @else
                    <td style="text-align:center">
                        <form action="{{ route('admins.posts.statuson',$post->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">上架</button>
                        </form>
                    </td>
                @endif
                <td style="text-align:center">
                    <form id="deleteForm" action="{{ route('admins.posts.destroy',$post->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete()">刪除</button>
                    </form>
                </td>

                <script>
                    function confirmDelete()
                    {
                        if (confirm("確定要刪除公告{{ $post->title }}嗎？")) {
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
