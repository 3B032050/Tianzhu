@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.courses.index') }}" class="custom-link"><i class="fa fa-home"></i>僧伽教育</a> &gt;
                要排序課程選擇
            </p>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="text-align:left">名稱</th>
{{--                <th scope="col" style="text-align:left">最新修改管理員</th>--}}
{{--                <th scope="col" style="text-align:center">編輯</th>--}}
                <th scope="col" style="text-align:center">排序</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courseCategories as $index => $courseCategory)
                <tr>
                    <td style="text-align:left">{{ $index + 1 }}</td>
                    <td>{{ $courseCategory->name }}</td>
{{--                    <td>--}}
{{--                        @if($courseCategory->lastModifiedByAdmin)--}}
{{--                            {{ $courseCategory->lastModifiedByAdmin->user->name }}--}}
{{--                        @else--}}
{{--                            無--}}
{{--                        @endif--}}
{{--                    </td>--}}
{{--                    <td style="text-align:center">--}}
{{--                        <a href="{{ route('admins.course_categories.edit',$courseCategory->id) }}" class="btn btn-secondary btn-sm">編輯</a>--}}
{{--                    </td>--}}
                    <td style="text-align:center">
                        <a href="{{ route('admins.courses.order_by', ['courseCategoryId' => $courseCategory->id]) }}" class="btn btn-primary btn-sm">排序</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
