@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.curricula.index') }}" class="custom-link"><i class="fa fa-home"></i>僧伽教育</a> &gt;
            <a href="{{ route('admins.curricula.by_category') }}" class="custom-link">課程類別</a> &gt;
            {{ $curriculumCategory->name }} 課程前台排序 (可拖動進行排序更換)
        </p>
    </div>
    <table class="table" id="sortable-list">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">名稱</th>
{{--            <th scope="col" style="width: 13%; text-align:left">最新修改管理員</th>--}}
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($curricula as $index => $curriculum)

            <tr data-id="{{ $curriculum->id }}">
                <td>{{ $index + 1 }}</td>
                <td>{{ $curriculum->title }}</td>
                <td  class="align-middle" style="text-align:center">
                    <a href="{{ route('admins.curricula.edit',$curriculum->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td class="align-middle" style="text-align:center">
                    <form id="deleteForm{{ $curriculum->id }}" action="{{ route('admins.curricula.destroy',$curriculum->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $curriculum->name }}', {{ $curriculum->id }})">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete(name, id)
                    {
                        if (confirm("確定要刪除課程類別「" + name + "」嗎？")) {
                            document.getElementById('deleteForm' + id).submit();
                        }
                    }
                </script>
            </tr>
        @endforeach
        </tbody>
    </table>

    <form action="{{ route('admins.curricula.update_order','sortedIds') }}" method="POST" role="form" enctype="multipart/form-data" id="sortableForm">
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
