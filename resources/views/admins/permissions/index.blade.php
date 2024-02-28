@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">權限管理</h1>

        <div class="row">
            <div class="col-md-6">
                <h2>一般管理員</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>功能</th>
                        <th>啟用/停用</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h2>高階管理員</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>功能</th>
                        <th>啟用/停用</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Add rows for advanced administrators here -->
                    <tr>
                        <td>佛門小常識</td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>課程講義</td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </td>
                    </tr>
                    <!-- Add more rows for other functionalities -->
                    </tbody>
                </table>
                <input type="checkbox" name="checkbox1">
            </div>
        </div>
    </div>

@endsection
