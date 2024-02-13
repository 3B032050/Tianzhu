@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">課程講義</h1>
    <a class="btn btn-success btn-sm" href="{{ route('admins.course_file_categories.index') }}">課程講義類別</a>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.course_file.create') }}">新增課程</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">課程名稱</th>
            <th scope="col" style="text-align:left">課程檔案</th>
        </tr>
        </thead>
        <tbody>
        @foreach($coursefiles as $index => $coursefile)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>

                <td>{{ $coursefile->title }}</td>
                <td>{{ $coursefile->file }}</td>
                <td style="text-align:center">
                    <a href="{{ route('admins.course_file.edit' ,['coursefile' => $coursefile->id]) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm{{ $coursefile->id }}" action="{{ route('admins.course_file.destroy',$coursefile->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $coursefile->title }}', {{ $coursefile->id }})">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete(coursetitle, courseId)
                    {
                        if (confirm("確定要刪除課程「" + coursetitle + "」嗎？")) {
                            document.getElementById('deleteForm' + courseId).submit();
                        }
                    }
                </script>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
