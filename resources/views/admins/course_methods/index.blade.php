@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.courses.index') }}" class="custom-link"><i class="fa fa-home"></i>僧伽教育</a> &gt;
            課程方式
        </p>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.course_methods.create') }}">新增課程方式</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">方式</th>
            <th scope="col" style="width: 13%; text-align:left">最新修改管理員</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courseMethods as $index => $courseMethod)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>
                <td>{{ $courseMethod->name }}</td>
                <td>
                    @if($courseMethod->lastModifiedByAdmin)
                        {{ $courseMethod->lastModifiedByAdmin->user->name }}
                    @else
                        無
                    @endif
                </td>
                <td style="text-align:center">
                    <a href="{{ route('admins.course_methods.edit',$courseMethod->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm{{ $courseMethod->id }}" action="{{ route('admins.course_methods.destroy',$courseMethod->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $courseMethod->name }}', {{ $courseMethod->id }})">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete(name, id)
                    {
                        if (confirm("確定要刪除課程方法「" + name + "」嗎？")) {
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
