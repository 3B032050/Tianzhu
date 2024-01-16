@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">課程目標</h1>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.course_objectives.create') }}">新增課程目標</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">目標</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courseObjectives as $index => $courseObjective)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>
                <td>{{ $courseObjective->description }}</td>
                <td style="text-align:center">
                    <a href="{{ route('admins.course_objectives.edit',$courseObjective->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm{{ $courseObjective->id }}" action="{{ route('admins.course_objectives.destroy',$courseObjective->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $courseObjective->description }}', {{ $courseObjective->id }})">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete(description, id)
                    {
                        if (confirm("確定要刪除課程目標「" + description + "」嗎？")) {
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
