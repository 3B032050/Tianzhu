@extends('admins.layouts.master')

@section('page-title', '活動紀實')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">活動紀實</h1>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.activities.create') }}">新增活動</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:center">活動名稱</th>
            <th scope="col" style="text-align:center">發佈時間</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($activities as $index => $activity)
            <tr>
                <td style="text-align:left">{{$index+1}}</td>
                <td style="text-align:center">{{$activity->title}}</td>
                <td style="text-align:center">{{$activity->updated_at}}</td>
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