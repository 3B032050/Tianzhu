
@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.videos.index') }}" class="custom-link"><i class="fa fa-home"></i>法音流佈</a>
            </p>
        </div>
        <h1 class="mt-4">法音流佈</h1>
        <div class="container px-4 px-lg-5 mt-2 mb-4">
            <form action="{{ route('admins.videos.search') }}" method="GET" class="d-flex">
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
                <a class="btn btn-success btn-sm" href="{{ route('admins.videos.index') }}">取消搜尋</a>
            </div>
        @endif
        <a class="btn btn-success btn-sm" href="{{ route('admins.video_categories.index') }}">影音類別</a>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('admins.videos.create') }}">新增影音</a>
        </div>
        <table class="table" id="sortable-list">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 10%; text-align:left;">影音類別</th>
                <th scope="col" style="width: 25%; text-align:left;">影音圖片</th>
                <th scope="col" style="width: 25%; text-align:left">影音標題</th>
                <th scope="col" style="width: 13%; text-align:left">最新修改管理員</th>

            </tr>
            </thead>
            <tbody>
            @foreach($videos as $index => $video)
                <tr data-id="{{ $video->id }}">
                    <td style="text-align:left">{{ $index + 1 }}</td>
                    <td>
                        @foreach($video_categories as $video_category)
                            @if($video->video_category_id == $video_category->id)
                                {{ $video_category->category_name }}
                            @endif
                        @endforeach
                    </td>
                    <td><img src="{{ $video->cover_url }}" alt="{{ $video->video_title }}" style="width: 300px; height: 200px;"></td>
                    <td>{{ $video->video_title }}</td>
                    <td>
                        @if($video->lastModifiedByAdmin)
                            {{ $video->lastModifiedByAdmin->user->name }}
                        @else
                            無
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form action="{{ route('admins.videos.update_order','sortedIds') }}" method="POST" role="form" enctype="multipart/form-data" id="sortableForm">
            @method('PATCH')
            @csrf
        </form>
        <style>
            #sortable-list {
                list-style-type: none;
                margin: 0;
                padding: 0;
            }

            #sortable-list tbody tr {
                cursor: grab;
                background-color: #eee;
                margin-bottom: 5px;
            }
        </style>
        <script>
            $("#saveOrderBtn").click(function () {
                console.log("保存排序按鈕被點擊");
            });

            $(document).ready(function () {
                $("#sortable-list tbody").sortable({
                    handle: 'td',
                    update: function (event, ui) {
                        saveNewOrder();
                    }
                }).disableSelection();
            });
        </script>
        <script>
            function saveNewOrder() {
                var sortedIds = $("#sortable-list tbody tr").map(function () {
                    return $(this).data("id");
                }).get();
                $("#sortableForm input[name='sortedIds']").remove();
                $("#sortableForm").append('<input type="hidden" name="sortedIds" value="' + sortedIds.join(',') + '">');
                $("#sortableForm").submit();
            }
        </script>
    </div>
@endsection
