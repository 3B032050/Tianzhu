@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">天筑精舍簡介</h1>
    <a class="btn btn-success btn-sm" href="{{ route('admins.introductions.traffic') }}">交通資訊</a>
    <a class="btn btn-success btn-sm" href="{{ route('admins.introductions.origin') }}">緣起與宗旨</a>
</div>
@endsection
