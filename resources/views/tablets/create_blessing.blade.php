@extends('layouts.master')

@section('title','消災牌位登記')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            <a href="{{ route('tablets.index') }}" class="custom-link">牌位登記</a> &gt;
            消災牌位登記
        </p>
    </div>
@endsection

@section('content')
    <section class="py-5">
        <div class="container text-center bg-red">
            <h2>消災牌位登記 Tablets for blessing</h2>
            <p>生者姓名 Name of Beneficiary</p>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group row justify-content-center">
                            <label for="name1" class="col-sm-4 col-form-label">姓名1</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="name1" name="name1" maxlength="6" placeholder="姓名 Full Name">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row justify-content-center">
                            <label for="name2" class="col-sm-4 col-form-label">姓名2</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="name2" name="name2" maxlength="6" placeholder="姓名 Full Name">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row justify-content-center">
                            <label for="name3" class="col-sm-4 col-form-label">姓名3</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="name3" name="name3" maxlength="6" placeholder="姓名 Full Name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group row justify-content-center">
                            <label for="name4" class="col-sm-4 col-form-label">姓名4</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="name4" name="name4" maxlength="6" placeholder="姓名 Full Name">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row justify-content-center">
                            <label for="name5" class="col-sm-4 col-form-label">姓名5</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="name5" name="name5" maxlength="6" placeholder="姓名 Full Name">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row justify-content-center">
                            <label for="name6" class="col-sm-4 col-form-label">姓名6</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="name6" name="name6" maxlength="6" placeholder="姓名 Full Name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label for="address" class="col-sm-2 col-form-label">地址</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="address" name="address" placeholder="請輸入地址" maxlength="30">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">提交</button>
            </form>
        </div>
    </section>
    <style>
        .bg-red {
            background-color: #FFD7D7; /* 淡紅色 */
        }
    </style>
@endsection

