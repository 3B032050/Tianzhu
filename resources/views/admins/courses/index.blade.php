@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">僧伽教育</h1>
    <a class="btn btn-success btn-sm" href="{{ route('admins.course_overviews.edit') }}">編輯總覽</a>
    <a class="btn btn-success btn-sm" href="{{ route('admins.course_categories.index') }}">課程分階</a>
    <a class="btn btn-success btn-sm" href="{{ route('admins.course_methods.index') }}">課程方式</a>
    <a class="btn btn-success btn-sm" href="{{ route('admins.course_objectives.index') }}">課程目標</a>
    <div class="container px-4 px-lg-5 mt-2 mb-4">
        <form action="{{ route('admins.courses.search') }}" method="GET" class="d-flex">
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="category">類別</label>
                </div>
                <select class="form-select" id="category" name="category">
                    <option value="all" selected>所有</option>
                    @foreach($course_categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="text" name="query" class="form-control me-2" placeholder="課程搜尋...">
            <button type="submit" class="btn btn-outline-dark">搜尋</button>
        </form>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.courses.create') }}">新增課程</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="width: 10%; text-align:left">課程分階</th>
            <th scope="col" style="width: 8%; text-align:left">類別</th>
            <th scope="col" style="width: 10%; text-align:left">課程名稱</th>
            <th scope="col" style="width: 15%; text-align:left">方式</th>
            <th scope="col" style="width: 15%; text-align:left">目標</th>
            <th scope="col" style="width: 5%; text-align:left">時間</th>
            <th scope="col" style="width: 8%; text-align:left">備註</th>
            <th scope="col" style="width: 8%; text-align:left">狀態</th>
            <th scope="col" style="text-align:center">發佈</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
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
                <td>
                    @if ($course->status == 0)
                        <div style="color:#ff3370; font-weight:bold;">
                            (未發佈)
                        </div>
                    @elseif ($course->status == 1)
                        <div style="color:#FFB233; font-weight:bold;">
                            (已發佈)
                        </div>
                    @endif
                </td>
                <td style="text-align:center">
                    @if ($course->status == 0)
                        <form action="{{ route('admins.courses.statusOn',$course->id) }}" method="POST" role="form">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">發佈</button>
                        </form>
                    @elseif ($course->status == 1)
                        <form action="{{ route('admins.courses.statusOff',$course->id) }}" method="POST" role="form">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">取消發佈</button>
                        </form>
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
