@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.users.index') }}" class="custom-link"><i class="fa fa-home"></i>用戶資料</a> &gt;
            用戶分類
        </p>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.user_classifications.create') }}">新增用戶分類</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">類別名稱</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($userClassifications as $index => $userClassification)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>
                <td>{{ $userClassification->name }}</td>
                <td style="text-align:center">
                    <a href="{{ route('admins.user_classifications.edit',$userClassification->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm{{ $userClassification->id }}" action="{{ route('admins.user_classifications.destroy',$userClassification->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $userClassification->name }}', {{ $userClassification->id }})">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete(name, id)
                    {
                        if (confirm("確定要刪除類別「" + name + "」嗎？")) {
                            document.getElementById('deleteForm' + id).submit();
                        }
                    }
                </script>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
