@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">網頁階層管理</h1>
{{--    <ol class="breadcrumb mb-4">--}}
{{--        <li class="breadcrumb-item active">用戶一覽表</li>--}}
{{--    </ol>--}}
{{--    <div class="alert alert-success alert-dismissible" role="alert" id="liveAlert">--}}
{{--        <strong>完成！</strong> 成功儲存用戶--}}
{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--    </div>--}}
    <br>
    <table class="table">
        <thead>
{{--        <tr>--}}
{{--            <th scope="col">#</th>--}}
{{--            <th scope="col" style="text-align:left">使用者id</th>--}}
{{--            <th scope="col" style="text-align:left">姓名</th>--}}
{{--            <th scope="col" style="text-align:left">階級</th>--}}
{{--            <th scope="col" style="text-align:left">電子信箱</th>--}}
{{--            <th scope="col" style="text-align:center">修改</th>--}}
{{--            <th scope="col" style="text-align:center">刪除</th>--}}
{{--        </tr>--}}
        </thead>
        <tbody>
        @php
            $data = [];
        @endphp
        @foreach($web_hierarchies as $web_hierarchy)
            @php
                $data[] = array(
                    'web_id'=>$web_hierarchy->web_id,
                    'parent_id'=>$web_hierarchy->parent_id,
                    'web_title'=>$web_hierarchy->title,
                );
            @endphp
            <script>
                function confirmDelete(title,web_id)
                {
                    if (confirm("確定要刪除階層「" + title +"」嗎？")) {
                        document.getElementById('deleteForm' + web_id).submit();
                    }
                }
            </script>
        @endforeach
        @php
            $controller = App::make('App\Http\Controllers\AdminWebHierarchiesController');
            $controller->web_print($data);
        @endphp
        </tbody>
    </table>
</div>
@endsection
