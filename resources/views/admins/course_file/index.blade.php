@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.course_file.index') }}" class="custom-link"><i class="fa fa-home"></i>課程講義</a> &gt;
        </p>
    </div>
    <h1 class="mt-4">課程講義</h1>
    <div class="container px-4 px-lg-5 mt-2 mb-4">
        <form action="{{ route('admins.course_file.search') }}" method="GET" class="d-flex">
            <select name="category" class="form-select me-2" aria-label="請選擇用標題或類別進行搜尋">
                <option value="title">標題</option>
                <option value="category">類別</option>
            </select>
            <input type="text" name="query" class="form-control me-2" placeholder="請輸入搜尋內容..">
            <button type="submit" class="btn btn-outline-dark">搜尋</button>
        </form>
    </div>
    @if (request()->has('query'))
        <div class="container px-4 px-lg-5 mt-2 mb-4">
            查找「{{ request('query') }}」
            <a class="btn btn-success btn-sm" href="{{ route('admins.course_file.search') }}">取消搜尋</a>
        </div>
    @endif
    <a class="btn btn-success btn-sm" href="{{ route('admins.course_file_categories.index') }}">課程講義類別</a>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.course_file.create') }}">新增課程</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">課程名稱</th>
            <th scope="col" style="text-align:left">課程類別</th>
            <th scope="col" style="text-align:left">課程檔案</th>
            <th scope="col" style="text-align:left">狀態</th>
            <th scope="col" style="text-align:center">發佈</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($coursefiles as $index => $coursefile)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>

                <td>{{ $coursefile->title }}</td>
                <td>{{ $coursefile->coursefilecategory->course_file_category_name }}</td>
                <td>{{ $coursefile->file }}</td>
                @if($coursefile->status=='0')
                    <td>
                        <div style="color:#ff3370; font-weight:bold;">
                            (未發佈)
                        </div>
                    </td>
                @else
                    <td>
                        <div style="color:#ffa600; font-weight:bold;">
                            (已發佈)
                        </div>
                    </td>
                @endif
                @if($coursefile->status=='0')
                    <td style="text-align:center">
                        <form action="{{ route('admins.course_file.statuson',$coursefile->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">發佈</button>
                        </form>
                    </td>
                @else
                    <td style="text-align:center">
                        <form action="{{ route('admins.course_file.statusoff',$coursefile->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">取消發佈</button>
                        </form>
                    </td>
                @endif

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
{{--    <div class="d-flex justify-content-between align-items-center mt-4">--}}
{{--        <div class="d-flex align-items-center">--}}
{{--            <span class="mr-1">每</span>--}}
{{--            <select id="records-per-page" class="form-control" onchange="changeRecordsPerPage()">--}}
{{--                <option value="5" {{ $coursefiles->perPage() == 5 ? 'selected' : '' }}>5</option>--}}
{{--                <option value="10" {{ $coursefiles->perPage() == 10 ? 'selected' : '' }}>10</option>--}}
{{--                <option value="20" {{ $coursefiles->perPage() == 20 ? 'selected' : '' }}>20</option>--}}
{{--            </select>--}}
{{--            <span class="ml-1">筆</span>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="d-flex justify-content-center">--}}
{{--        @if ($coursefiles->currentPage() > 1)--}}
{{--            @if ($coursefiles->onFirstPage())--}}
{{--                <span class="mx-2">第 {{ $coursefiles->firstItem() }} 到 {{ $coursefiles->lastItem() }} 筆資料，共 {{ $coursefiles->total() }} 筆</span>--}}
{{--            @else--}}
{{--                <a href="{{ $coursefiles->previousPageUrl() }}" class="btn btn-secondary">上一頁</a>--}}
{{--            @endif--}}

{{--        @endif--}}

{{--        <span class="mx-2">全部 {{ $coursefiles->total() }} 筆資料，目前位於第 {{ $coursefiles->currentPage() }} 頁，共 {{ $coursefiles->lastPage() }} 頁</span>--}}

{{--        @if ($coursefiles->hasMorePages())--}}
{{--                @if ($coursefiles->hasMorePages())--}}
{{--                    <a href="{{ $coursefiles->nextPageUrl() }}" class="btn btn-secondary">下一頁</a>--}}
{{--                @else--}}
{{--                    <span class="mx-2">第 {{ $coursefiles->firstItem() }} 到 {{ $coursefiles->lastItem() }} 筆資料，共 {{ $coursefiles->total() }} 筆</span>--}}
{{--                @endif--}}

{{--            @endif--}}
{{--    </div>--}}
{{--    <script>--}}
{{--        function changeRecordsPerPage() {--}}
{{--            const select = document.getElementById('records-per-page');--}}
{{--            const value = select.options[select.selectedIndex].value;--}}
{{--            window.location.href = `{{ route('admins.course_file.index') }}?perPage=${value}`;--}}
{{--        }--}}
{{--    </script>--}}
@endsection
