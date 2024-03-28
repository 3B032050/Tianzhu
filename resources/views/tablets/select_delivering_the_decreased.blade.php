@extends('layouts.master')

@section('title','消災牌位登記')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            <a href="{{ route('tablets.index') }}" class="custom-link">牌位登記</a> &gt;
            超薦牌位選擇欄位
        </p>
    </div>
@endsection

@section('content')
    <section class="py-5">
        <div class="container text-center bg-yellow">
            <h2>超薦牌位選擇欄位 Tablets for delivering the decreased</h2>
            <form action="{{ route('tablets.create_delivering_the_decreased') }}" method="GET">
                <div class="form-check d-flex justify-content-center align-items-center">
                    <input class="form-check-input me-2" type="checkbox" name="columns[]" value="姓名" id="column1">
                    <label class="form-check-label" for="column1">
                        列舉姓名
                    </label>
                </div>
                <div class="form-check d-flex justify-content-center align-items-center">
                    <input class="form-check-input me-2" type="checkbox" name="columns[]" value="歷代祖先" id="column2">
                    <label class="form-check-label" for="column2">
                        歷代祖先
                    </label>
                </div>
                <div class="form-check d-flex justify-content-center align-items-center">
                    <input class="form-check-input me-2" type="checkbox" name="columns[]" value="冤親債主" id="column3">
                    <label class="form-check-label" for="column3">
                        冤親債主
                    </label>
                </div>
                <div class="form-check d-flex justify-content-center align-items-center">
                    <input class="form-check-input me-2" type="checkbox" name="columns[]" value="地基主" id="column4">
                    <label class="form-check-label" for="column4">
                        地基主
                    </label>
                </div>
                <button type="submit" class="btn btn-success mt-3">提交</button>
            </form>
        </div>
    </section>
    <style>
        .bg-yellow {
            background-color: #FDFFE4; /* 淡黃色 */
        }
    </style>
@endsection

