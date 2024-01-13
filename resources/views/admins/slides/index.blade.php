@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">幻燈片設定</h1>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('admins.slides.create') }}">新增圖片</a>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:center">標題</th>
            <th scope="col" style="text-align:center">圖片</th>
            <th scope="col" style="text-align:center">狀態</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($slides as $index => $slide)
            <tr>
                <td class="align-middle" style="text-align:center">{{ $index + 1 }}</td>
                <td class="align-middle" style="text-align:center">{{ $slide->title }}</td>
                <td class="align-middle" style="text-align:center">
                    <img src="{{ asset( 'storage/slides/' . $slide->image_path) }}" alt="{{ $slide->title }}" height="90px" width="200px">
                </td>
                <td class="align-middle" style="text-align:center">{{ $slide->status }}
                    @if ($slide->status == '1')
                        (hidden)
                    @else
                        (visible)
                    @endif
                </td>
                <td class="align-middle" style="text-align:center">
                    <a href="{{ route('admins.slides.edit',$slide->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td class="align-middle" style="text-align:center">
                    <form id="deleteForm" action="{{ route('admins.slides.destroy', $slide->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $slide->title }}')">刪除</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script>
        function confirmDelete(title) {
            if (confirm('確定要刪除 ' + title + ' 嗎？')) {
                // 如果用戶確認刪除，提交表單
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
@endsection
