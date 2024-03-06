@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.courses.index') }}" class="custom-link"><i class="fa fa-home"></i>僧伽教育</a> &gt;
            課程分階
        </p>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.course_categories.create') }}">新增課程分階</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">名稱</th>
            <th scope="col" style="width: 13%; text-align:left">最新修改管理員</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courseCategories as $index => $courseCategory)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>
                <td>{{ $courseCategory->name }}</td>
                <td>
                    @if($courseCategory->lastModifiedByAdmin)
                        {{ $courseCategory->lastModifiedByAdmin->user->name }}
                    @else
                        無
                    @endif
                </td>
                <td style="text-align:center">
                    <a href="{{ route('admins.course_categories.edit',$courseCategory->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm{{ $courseCategory->id }}" action="{{ route('admins.course_categories.destroy',$courseCategory->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $courseCategory->name }}', {{ $courseCategory->id }})">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete(name, id)
                    {
                        if (confirm("確定要刪除課程分階「" + name + "」嗎？")) {
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
