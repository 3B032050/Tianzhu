@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.common_senses.index') }}" class="custom-link"><i class="fa fa-home"></i>佛門小常識</a> &gt;
            小常識類別
        </p>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.common_sense_categories.create') }}">新增小常識類別</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">名稱</th>
            <th scope="col" style="width: 13%; text-align:left">最新修改管理員</th>
            <th scope="col" style="text-align:left">狀態</th>
        </tr>
        </thead>
        <tbody>
        @foreach($common_sense_categories as $index => $common_sense_category)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>
                <td>{{ $common_sense_category->name }}</td>
                <td>
                    @if($common_sense_category->lastModifiedByAdmin)
                        {{ $common_sense_category->lastModifiedByAdmin->user->name }}
                    @else
                        無
                    @endif
                </td>
                <td>
                    @if ($common_sense_category->status == 0)
                        <div style="color:#ff3370; font-weight:bold;">
                            (下架)
                        </div>
                    @else
                        <div style="color:#ffa600; font-weight:bold;">
                            (上架)
                        </div>
                    @endif
                </td>
                <td>
                    @if ($common_sense_category->status == 0)
                        <form action="{{ route('admins.common_sense_categories.status_on',$common_sense_category->id) }}" method="POST" role="form">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">上架</button>
                        </form>
                    @else
                        <form action="{{ route('admins.common_sense_categories.status_off',$common_sense_category->id) }}" method="POST" role="form">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">下架</button>
                        </form>
                    @endif
                </td>
                <td style="text-align:center">
                    <a href="{{ route('admins.common_sense_categories.edit',$common_sense_category->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm{{ $common_sense_category->id }}" action="{{ route('admins.common_sense_categories.destroy',$common_sense_category->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $common_sense_category->name }}', {{ $common_sense_category->id }})">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete(name, id)
                    {
                        if (confirm("確定要刪除課程分階「" + name + "」嗎？")) {
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
