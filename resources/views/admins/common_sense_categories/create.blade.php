@extends('admins.layouts.master')

@section('page-title', 'Create article')

@section('page-content')
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.common_senses.index') }}" class="custom-link"><i class="fa fa-home"></i>佛門小常識</a> &gt;
                <a href="{{ route('admins.common_sense_categories.index') }}" class="custom-link">小常識類別</a> &gt;
                新增小常識類別
            </p>
        </div>
        @include('admins.layouts.shared.errors')
        <form action="{{ route('admins.common_sense_categories.store') }}" method="POST" role="form">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">類別名稱</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}" placeholder="請輸入類別名稱">
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary btn-sm">儲存</button>
            </div>
        </form>
    </div>
@endsection


