@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">居士學佛</h1>
{{--        <a class="btn btn-success btn-sm" href="{{ route('admins.course_overviews.edit') }}">編輯總覽</a>--}}
        <a class="btn btn-success btn-sm" href="{{ route('admins.curriculum_categories.index') }}">課程類別</a>
        <a class="btn btn-success btn-sm" href="{{ route('admins.curriculum_methods.index') }}">課程方式</a>
        <a class="btn btn-success btn-sm" href="{{ route('admins.curriculum_objectives.index') }}">課程目標</a>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('admins.curricula.create') }}">新增課程</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="text-align:left">類別</th>
                <th scope="col" style="text-align:left">課程名稱</th>
                <th scope="col" style="text-align:left">方式</th>
                <th scope="col" style="text-align:left">目標</th>
            </tr>
            </thead>
            <tbody>
            @foreach($curricula as $index => $curriculum)
                <tr>
                    <td style="text-align:left">{{ $index + 1 }}</td>
                    <td>
                        @if ($curriculum->category)
                            {{ $curriculum->category->name }}
                        @else
                            未分類
                        @endif
                    </td>
                    <td>{{ $curriculum->title }}</td>
                    <td>
                        @foreach($curriculum->methods as $index_method => $method)
                            {{ $index_method + 1 }}
                            {{ $method->name }}
                            @if(!$loop->last)
                                <br>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($curriculum->objectives as $index_objective => $objective)
                            {{ $index_objective + 1 }}
                            {{ $objective->description }}
                            @if(!$loop->last)
                                <br>
                            @endif
                        @endforeach
                    </td>
                    <td style="text-align:center">
                        <a href="{{ route('admins.curricula.edit',$curriculum->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                    </td>
                    <td style="text-align:center">
                        <form id="deleteForm{{ $curriculum->id }}" action="{{ route('admins.curricula.destroy',$curriculum->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $curriculum->title }}', {{ $curriculum->id }})">刪除</button>
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
