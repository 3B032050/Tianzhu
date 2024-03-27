@extends('layouts.master')

@section('title','消災牌位登記')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            <a href="{{ route('tablets.index') }}" class="custom-link">牌位登記</a> &gt;
            <a href="{{ route('tablets.select_delivering_the_decreased') }}" class="custom-link">牌位登記</a> &gt;
            超薦牌位登記
        </p>
    </div>
@endsection

@section('content')
    <section class="py-5">
        <div class="container text-center bg-yellow">
            <h2>超薦牌位登記 Tablets for blessing</h2>
            <p>姓名請依序填寫</p>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="row">
                    @php
                        $count = 0;
                    @endphp
                    @for ($i = 1; $i <= $nameInputs; $i++)
                        @if ($count % 3 == 0)
                </div>
                <div class="row">
                    @endif
                    <div class="col">
                        <div class="form-group row justify-content-center">
                            <label for="name{{$i}}" class="col-sm-4 col-form-label">亡者{{$i}}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="name{{$i}}" name="name{{$i}}" maxlength="6" placeholder="亡者 Decreased name">
                            </div>
                        </div>
                    </div>
                    @php
                        $count++;
                    @endphp
                    @endfor
                </div>
                @if ($ancestorInputs > 0)
                    @for ($j = 1; $j <= $ancestorInputs; $j++)
                        <div class="form-group row justify-content-center">
                            <label for="ancestor{{$j}}" class="col-sm-2 col-form-label">歷代祖先</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="ancestor{{$j}}" name="ancestor{{$j}}" placeholder="請輸入姓氏" maxlength="1">
                            </div>
                            <div class="col-sm-2 pt-2">
                                <span>氏歷代祖先</span>
                            </div>
                        </div>
                    @endfor
                @endif
                @if ($debtInputs > 0)
                    <div class="form-group row justify-content-center">
                        <label for="debt" class="col-sm-2 col-form-label">冤親債主</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="debt" name="debt" value="累世父母師長冤親債主" placeholder="累世父母師長冤親債主" readonly>
                        </div>
                    </div>
                @endif
                @if ($landlordInputs > 0)
                    <div class="form-group row justify-content-center">
                        <label for="landlord" class="col-sm-2 col-form-label">地基主</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="landlord" name="landlord" value="地基主" placeholder="地基主" readonly>
                        </div>
                    </div>
                @endif
                <div class="form-group row justify-content-center">
                    <label for="address" class="col-sm-2 col-form-label">地址</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="address" name="address" placeholder="請輸入地址" maxlength="30">
                    </div>
                </div>
                <div class="row">
                    @for ($i = 1; $i <= $yangShangInputs; $i++)
                        <div class="col">
                            <div class="form-group row justify-content-center">
                                <label for="yangShang{{$i}}" class="col-sm-4 col-form-label">陽上人{{$i}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" id="yangShang{{$i}}" name="yangShang{{$i}}" maxlength="6" placeholder="陽上 Living name">
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                <button type="submit" class="btn btn-success">提交</button>
            </form>
        </div>
    </section>
    <style>
        .bg-yellow {
            background-color: #FDFFE4; /* 淡黃色 */
        }
    </style>
@endsection


