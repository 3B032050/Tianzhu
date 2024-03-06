@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.course_file.index') }}" class="custom-link"><i class="fa fa-home"></i>課程講義</a> &gt;
            課程講義類別
        </p>
    </div>
    <h1 class="mt-4">課程講義類別</h1>
    <a class="btn btn-success btn-sm" href="{{ route('admins.course_file.index') }}">課程講義</a>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.course_file_categories.create') }}">新增課程講義類別</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">課程講義類別名稱</th>
            <th scope="col" style="width: 13%; text-align:left">最新修改管理員</th>
        </tr>
        </thead>
        <tbody>
        @foreach($course_file_categories as $index => $course_file_category)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>
                <td>{{ $course_file_category->course_file_category_name }}</td>
                <td>
                    @if($course_file_category->lastModifiedByAdmin)
                        {{ $course_file_category->lastModifiedByAdmin->user->name }}
                    @else
                        無
                    @endif
                </td>
                <td style="text-align:center">
                    <a href="{{ route('admins.course_file_categories.edit' ,['course_file_category' => $course_file_category->id]) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm{{ $course_file_category->id }}" action="{{ route('admins.course_file_categories.destroy',$course_file_category->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $course_file_category->name }}', {{ $course_file_category->id }})">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete(coursefilecategory, coursefilecategoryId)
                    {
                        if (confirm("確定要刪除類別「" + coursefilecategory + "」嗎？")) {
                            document.getElementById('deleteForm' + coursefilecategoryId).submit();
                        }
                    }
                </script>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
