@extends('layouts.master')

@section('title','個人資料')

@section('content')
<section id="location">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('個人資料') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update',$user->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('帳號 / Account') }}</label>
                            <div class="col-md-6">
                                {{ $user->account }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('姓名 / Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" placeholder="必填" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('信箱 / Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="必填" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('性別 / Sex') }}</label>

                            <div class="col-md-6">
                                <div class="col-md-6">
                                    @if ($user->sex == '男')
                                        男<input id="sex" type="radio" name="sex" value="{{ '男' }}" required autocomplete="sex" checked="checked">
                                        女<input id="sex" type="radio" name="sex" value="{{ '女' }}" required autocomplete="sex">
                                    @else
                                        男<input id="sex" type="radio" name="sex" value="{{ '男' }}" required autocomplete="sex">
                                        女<input id="sex" type="radio" name="sex" value="{{ '女' }}" required autocomplete="sex" checked="checked">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="birthday" class="col-md-4 col-form-label text-md-end">{{ __('生日 / Birthday') }}</label>

                            <div class="col-md-6">
                                <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ $user->birthday }}" required autocomplete="current-password">

                                @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('電話 / Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="current-password" placeholder="必填">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cityline" class="col-md-4 col-form-label text-md-end">{{ __('市內電話 / Cityline') }}</label>

                            <div class="col-md-6">
                                <input id="cityline" type="text" class="form-control @error('cityline') is-invalid @enderror" name="cityline" value="{{ $user->cityline }}" autocomplete="current-cityline" placeholder="選填">

                                @error('cityline')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('地址 / Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $user->address }}" autocomplete="current-address" placeholder="選填">

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="classification" class="col-md-4 col-form-label text-md-end">{{ __('類別 / Classification') }}</label>

                            <div class="col-md-6">
                                <select id="classification" class="form-control @error('classification') is-invalid @enderror" name="classification" required autocomplete="current-classification">
                                    @foreach($classifications as $classification)
                                        <option value="{{ $classification->name }}" {{ $user->classification == $classification->name ? 'selected' : '' }}>
                                            {{ $classification->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('classification')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('儲存') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
