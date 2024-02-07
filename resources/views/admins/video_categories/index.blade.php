@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
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
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $videocategory->name }}', {{ $videocategory->id }})">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete(videocategory, videocateegoryId)
                    {
                        if (confirm("確定要刪除類別「" + videocateegory + "」嗎？")) {
                            document.getElementById('deleteForm' + videocateegoryId).submit();
                        }
                    }
                </script>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
