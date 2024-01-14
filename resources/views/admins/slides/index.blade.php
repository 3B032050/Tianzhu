@extends('admins.layouts.master')

@section('page-title', 'Slide list')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">幻燈片設定</h1>
        <ol class="breadcrumb mb-4">
            <strong><li class="breadcrumb-item active">(可拖動圖片進行排序)</li></strong>
        </ol>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('admins.slides.create') }}">新增圖片</a>
        </div>
    </div>
    <table class="table" id="sortable-list">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:center">圖片</th>
            <th scope="col" style="text-align:center">狀態</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($slides as $index => $slide)
            <tr data-id="{{ $slide->id }}">
                <td class="align-middle" style="text-align:center">{{ $index + 1 }}</td>
                <td class="align-middle" style="text-align:center">
                    <img src="{{ asset( 'storage/slides/' . $slide->image_path) }}" alt="{{ $slide->title }}" height="90px" width="200px">
                </td>
                <td class="align-middle" style="text-align:center">
                    @if ($slide->status == '1')
                        <font color="red">(不顯示)</font>
                    @else
                        <font color="blue">(顯示)</font>
                    @endif
                </td>
                <td class="align-middle" style="text-align:center">
                    <a href="{{ route('admins.slides.edit', $slide->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td class="align-middle" style="text-align:center">
                    <form id="deleteForm{{ $slide->id }}" action="{{ route('admins.slides.destroy', $slide->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $slide->title }}', {{ $slide->id }})">刪除</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <form action="{{ route('admins.slides.update_order','sortedIds') }}" method="POST" role="form" enctype="multipart/form-data" id="sortableForm">
        @method('PATCH')
        @csrf
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
{{--            <button type="submit" class="btn btn-primary">保存排序</button>--}}
        </div>
    </form>
    <script>
        // 提示用户确认删除
        function confirmDelete(title, id) {
            if (confirm('確定要刪除 ' + title + ' 嗎？')) {
                // 如果用户确认删除，提交表单
                document.getElementById('deleteForm' + id).submit();
            }
        }
    </script>
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
            // 以下是原有的代碼...
            // saveNewOrder(); // 如果你想點擊按鈕時也執行排序操作，可以呼叫 saveNewOrder 函式
        });

        $(document).ready(function () {
            // jQuery UI Sortable 初始化
            $("#sortable-list tbody").sortable({
                handle: 'td',
                update: function (event, ui) {
                    // 在排序更新时执行的操作
                    saveNewOrder();
                }
            }).disableSelection();
        });
    </script>
    <script>
        function saveNewOrder() {
            // 獲取排序後的順序
            var sortedIds = $("#sortable-list tbody tr").map(function () {
                return $(this).data("id");
            }).get();

            $("#sortableForm input[name='sortedIds']").remove();

            // 將排序後的順序填充到一個隱藏的 input 中
            $("#sortableForm").append('<input type="hidden" name="sortedIds" value="' + sortedIds.join(',') + '">');


            // 提交表單
            $("#sortableForm").submit();
        }
    </script>
@endsection
