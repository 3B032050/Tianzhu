@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">佛門小常識</h1>
        <a class="btn btn-success btn-sm" href="{{ route('admins.common_sense_categories.index') }}">小常識類別</a>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('admins.common_senses.create') }}">新增資料</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="text-align:left">類別</th>
                <th scope="col" style="text-align:left">標題</th>
            </tr>
            </thead>
            <tbody>
            @foreach($common_senses as $index => $common_sense)
                <tr>
                    <td style="text-align:left">{{ $index + 1 }}</td>
                    <td>
                        @if ($common_sense->category)
                            {{ $common_sense->category->name }}
                        @else
                            未分類
                        @endif
                    </td>
                    <td>{{ $common_sense->title }}</td>
                    <td style="text-align:center">
                        <a href="{{ route('admins.common_senses.edit',$common_sense->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                    </td>
                    <td style="text-align:center">
                        <form id="deleteForm{{ $common_sense->id }}" action="{{ route('admins.common_senses.destroy',$common_sense->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $common_sense->title }}', {{ $common_sense->id }})">刪除</button>
                        </form>
                    </td>
                    <script>
                        function confirmDelete(coursetitle, courseId)
                        {
                            if (confirm("確定要刪除「" + coursetitle + "」嗎？")) {
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
