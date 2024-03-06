@extends('admins.layouts.master')

@section('page-title', '活動紀實')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">活動紀實</h1>
    <div class="container px-4 px-lg-5 mt-2 mb-4">
        <form action="{{ route('admins.activities.search') }}" method="GET" class="d-flex">
            <input type="text" name="query" class="form-control me-2" placeholder="活動搜尋...">
            <button type="submit" class="btn btn-outline-dark">搜尋</button>
        </form>
    </div>
    @if (request()->has('query'))
        <div class="container px-4 px-lg-5 mt-2 mb-4">
            查找「{{ request('query') }}」
            <a class="btn btn-success btn-sm" href="{{ route('admins.activities.index') }}">取消搜尋</a>
        </div>
    @endif
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.activities.create') }}">新增活動</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">活動名稱</th>
            <th scope="col" style="text-align:left">發佈時間</th>
            <th scope="col" style="width: 13%; text-align:left">最新修改管理員</th>
            <th scope="col" style="text-align:left">狀態</th>
            <th scope="col" style="text-align:center">發佈</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($activities as $index => $activity)
            <tr>
                <td style="text-align:left">{{$index+1}}</td>
                <td style="text-align:left">{{$activity->title}}</td>
                <td style="text-align:left">{{$activity->updated_at}}</td>
                <td>
                    @if($activity->lastModifiedByAdmin)
                        {{ $activity->lastModifiedByAdmin->user->name }}
                    @else
                        無
                    @endif
                </td>
                <td style="text-align:left">
                    @if ($activity->status == 0)
                        <div style="color:#ff3370; font-weight:bold;">
                            (未發佈)
                        </div>
                    @elseif ($activity->status == 1)
                        <div style="color:#FFB233; font-weight:bold;">
                            (已發佈)
                        </div>
                    @endif
                </td>
                <td style="text-align:center">
                    @if ($activity->status == 0)
                        <form action="{{ route('admins.activities.statusOn',$activity->id) }}" method="POST" role="form">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">發佈</button>
                        </form>
                    @elseif ($activity->status == 1)
                        <form action="{{ route('admins.activities.statusOff',$activity->id) }}" method="POST" role="form">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">取消發佈</button>
                        </form>
                    @endif
                </td>
                <td style="text-align:center">
                    <a href="{{ route('admins.activities.edit',$activity->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm{{ $activity->id }}" action="{{ route('admins.activities.destroy',$activity->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $activity->title }}', {{ $activity->id }})">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete(name, id)
                    {
                        if (confirm("確定要刪除活動「" + name + "」嗎？")) {
                            document.getElementById('deleteForm' + id).submit();
                        }
                    }
                </script>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection
