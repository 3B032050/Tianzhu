@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">僧伽教育</h1>
    <a class="btn btn-success btn-sm" href="{{ route('admins.course_overviews.edit') }}">編輯總覽</a>
    <a class="btn btn-success btn-sm" href="{{ route('admins.course_categories.index') }}">課程分階</a>
    <a class="btn btn-success btn-sm" href="{{ route('admins.course_methods.index') }}">課程方式</a>
    <a class="btn btn-success btn-sm" href="{{ route('admins.course_objectives.index') }}">課程目標</a>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.courses.create') }}">新增課程</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">課程分階</th>
            <th scope="col" style="text-align:left">類別</th>
            <th scope="col" style="text-align:left">課程名稱</th>
            <th scope="col" style="text-align:left">方式</th>
            <th scope="col" style="text-align:left">目標</th>
            <th scope="col" style="text-align:left">時間</th>
            <th scope="col" style="text-align:left">備註</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courses as $index => $course)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>
                <td>
                    @if ($course->category)
                        {{ $course->category->name }}
                    @else
                        未分階
                    @endif
                </td>
                <td>
                    @if ($course->method)
                        {{ $course->method }}
                    @else
                        未分類
                    @endif
                </td>
                <td>{{ $course->title }}</td>
                <td>
                    @foreach($course->methods as $index_method => $method)
                        {{ $index_method + 1 }}
                        {{ $method->name }}
                        @if(!$loop->last)
                            <br>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach($course->objectives as $objective)
                        {{ $objective->description }}
                        @if(!$loop->last)
                            <br>
                        @endif
                    @endforeach
                </td>
                <td>
                    @if ($course->time)
                        {{ $course->time }}
                    @else
                        無
                    @endif
                </td>
                <td>
                    @if ($course->note)
                        {{ $course->note }}
                    @else
                        無
                    @endif
                </td>
                <td style="text-align:center">
                    <a href="{{ route('admins.courses.edit',$course->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm{{ $course->id }}" action="{{ route('admins.courses.destroy',$course->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $course->title }}', {{ $course->id }})">刪除</button>
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
