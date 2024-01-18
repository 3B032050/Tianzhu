@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.curricula.index') }}" class="custom-link"><i class="fa fa-home"></i>居士學佛</a> &gt;
            課程方式
        </p>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.curriculum_methods.create') }}">新增課程方式</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">方式</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($curriculumMethods as $index => $curriculumMethod)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>
                <td>{{ $curriculumMethod->name }}</td>
                <td style="text-align:center">
                    <a href="{{ route('admins.curriculum_methods.edit',$curriculumMethod->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm{{ $curriculumMethod->id }}" action="{{ route('admins.curriculum_methods.destroy',$curriculumMethod->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $curriculumMethod->name }}', {{ $curriculumMethod->id }})">刪除</button>
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
