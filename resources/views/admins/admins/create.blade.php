@extends('admins.layouts.master')

@section('page-title', 'Create article')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">管理員等級管理</h1>

        <form action="{{ route('admins.users.store') }}" method="POST" role="form">
            @method('POST')
            @csrf

            <div class="form-group">
                <label for="account" class="form-label">選擇使用者帳號</label>

                <select id="nameid" name="account" class="form-control" onchange="navigateToRoute(this.value)">
                    <option value="" selected disabled>請選擇使用者</option>

                    @foreach($users as $user)
                        <option value="{{ route('admins.admins.create_selected', ['id' => $user->id]) }}">{{ $user->account }}</option>
                    @endforeach
                </select>

{{--                <select class="js-example-basic-single" name="state">--}}
{{--                    <option value="AL">111</option>--}}
{{--                    <option value="ML">222</option>--}}
{{--                </select>--}}
{{--                <script>--}}
{{--                    $(document).ready(function() {--}}
{{--                        $('.js-example-basic-single').select2();--}}
{{--                    });--}}
{{--                </script>--}}
            </div>
        </form>
    </div>

    <script>
        function navigateToRoute(selectedUserId) {
            if (selectedUserId) {
                window.location.href = selectedUserId;
            }
        }
    </script>

@endsection
