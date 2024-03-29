@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.curricula.index') }}" class="custom-link"><i class="fa fa-home"></i>居士學佛</a> &gt;
            課程目標
        </p>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.curriculum_objectives.create') }}">新增課程目標</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">目標</th>
            <th scope="col" style="width: 13%; text-align:left">最新修改管理員</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($curriculumObjectives as $index => $curriculumObjective)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>
                <td>{{ $curriculumObjective->description }}</td>
                <td>
                    @if($curriculumObjective->lastModifiedByAdmin)
                        {{ $curriculumObjective->lastModifiedByAdmin->user->name }}
                    @else
                        無
                    @endif
                </td>
                <td style="text-align:center">
                    <a href="{{ route('admins.curriculum_objectives.edit',$curriculumObjective->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm{{ $curriculumObjective->id }}" action="{{ route('admins.curriculum_objectives.destroy',$curriculumObjective->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $curriculumObjective->description }}', {{ $curriculumObjective->id }})">刪除</button>
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
