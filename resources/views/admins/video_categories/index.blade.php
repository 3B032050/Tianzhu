@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.videos.index') }}" class="custom-link"><i class="fa fa-home"></i>法音流佈</a> >
           法音類別 (可拖動進行排序更換)
        </p>
    </div>
    <h1 class="mt-4">影音類別</h1>
    <a class="btn btn-success btn-sm" href="{{ route('admins.videos.index') }}">法音流佈</a>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.video_categories.create') }}">新增影音類別</a>
    </div>
    <table class="table" id="sortable-list">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">影音類別名稱</th>
            <th scope="col" style="width: 13%; text-align:left">最新修改管理員</th>
        </tr>
        </thead>
        <tbody>
        @foreach($videoCategories as $index => $videocategory)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>

                <td>{{ $videocategory->category_name }}</td>
                <td>
                    @if($videocategory->lastModifiedByAdmin)
                        {{ $videocategory->lastModifiedByAdmin->user->name }}
                    @else
                        無
                    @endif
                </td>
                <td style="text-align:center">
                    <a href="{{ route('admins.video_categories.edit' ,['video_category' => $videocategory->id]) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm{{ $videocategory->id }}" action="{{ route('admins.video_categories.destroy',$videocategory->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $videocategory->category_name }}', {{ $videocategory->id }})">刪除</button>
                    </form>
                </td>

                <script>
                    function confirmDelete(videocategoryname, videocategoryId)
                    {
                        if (confirm("確定要刪除類別「" + videocategoryname + "」嗎？")) {
                            document.getElementById('deleteForm' + videocategoryId).submit();
                        }
                    }
                </script>
            </tr>
        @endforeach
        </tbody>
    </table>
    <form action="{{ route('admins.video_categories.update_order','sortedIds') }}" method="POST" role="form" enctype="multipart/form-data" id="sortableForm">
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
