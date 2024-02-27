@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.videos.index') }}" class="custom-link"><i class="fa fa-home"></i>法音流佈</a> >
           法音類別
        </p>
    </div>
    <h1 class="mt-4">影音類別</h1>
    <a class="btn btn-success btn-sm" href="{{ route('admins.videos.index') }}">法音流佈</a>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.video_categories.create') }}">新增影音類別</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">影音類別名稱</th>
        </tr>
        </thead>
        <tbody>
        @foreach($videoCategories as $index => $videocategory)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>

                <td>{{ $videocategory->category_name }}</td>
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
</div>
@endsection
