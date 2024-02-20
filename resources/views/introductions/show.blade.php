@extends('layouts.master')

@section('title','天筑精舍')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            {{ $introduction->title }}
        </p>
    </div>
@endsection

@section('content')
    <section id="location">
        <div class="wrapper mx-auto" style="text-align:center;">
            <div class="card" style="width: 60rem; margin: auto;">
                <h5 class="card-title">{{ $introduction->title }}</h5>
                <div class="card-body text-start">
                    <p class="card-text">{!! $introduction->content !!}</p>
                </div>
                <figure class="table">
                    <table>
                        <tbody>
                        <tr>
                            <td>a</td>
                            <td>b</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>c</td>
                            <td><a href="https://www.youtube.com/watch?v=M4mYAPnKALs">d</a></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>e</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
            </div>
        </div>
    </section>
@endsection
