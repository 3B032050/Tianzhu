@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">權限管理</h1><br>
        <div class="row">
            <div class="col-md-6">
                <h3>一般管理員</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>功能</th>
                        <th>停用/啟用</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        @if($permission->position == 3)
                            <tr>
                                <td>{{ $permission->function }}</td>
                                <td>
                                    @if($permission->status == 1)
                                        <form action="{{ route('admins.permissions.off', $permission->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-link" style="font-size: 1.8em;"><i class="fa-solid fa-toggle-on"></i></button>
                                        </form>
                                    @else
                                        <form action="{{ route('admins.permissions.on', $permission->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-link" style="font-size: 1.8em;"><i class="fa-solid fa-toggle-off"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h3>高階管理員</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>功能</th>
                        <th>停用/啟用</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        @if($permission->position == 2)
                            <tr>
                                <td>{{ $permission->function }}</td>
                                <td>
                                    @if($permission->status == 1)
                                        <form action="{{ route('admins.permissions.off', $permission->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-link" style="font-size: 1.8em;"><i class="fa-solid fa-toggle-on"></i></button>
                                        </form>
                                    @else
                                        <form action="{{ route('admins.permissions.on', $permission->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-link" style="font-size: 1.8em;"><i class="fa-solid fa-toggle-off"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
