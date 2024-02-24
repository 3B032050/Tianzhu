@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">影印</h1>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.image_prints.create') }}">新增圖片</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:center">標題</th>
            <th scope="col" style="text-align:center">圖片</th>
            <th scope="col" style="text-align:center">影印</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($imagePrints as $index => $imagePrint)
            <tr>
                <td style="text-align:left">{{$index+1}}</td>
                <td style="text-align:center">{{$imagePrint->name}}</td>
                <td style="text-align:center"><img src="{{ asset( 'storage/image_prints/' . $imagePrint->image_url) }}" alt="{{ $imagePrint->name }}" height="300px" width="200px"></td>
                <td style="text-align:center">
                    <a href="{{ route('admins.image_prints.preview',$imagePrint->id) }}" class="btn btn-secondary btn-sm">影印</a>
                </td>
                <td style="text-align:center">
                    <a href="{{ route('admins.image_prints.edit',$imagePrint->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm" action="{{ route('admins.image_prints.destroy',$imagePrint->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete()">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete()
                    {
                        if (confirm("確定要刪除圖片{{ $imagePrint->name }}嗎？")) {
                            document.getElementById('deleteForm').submit();
                        }
                    }
                </script>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
