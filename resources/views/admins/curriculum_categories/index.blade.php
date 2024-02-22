@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.curricula.index') }}" class="custom-link"><i class="fa fa-home"></i>居士學佛</a> &gt;
                課程類別
            </p>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('admins.curriculum_categories.create') }}">新增課程類別</a>
        </div>
        <table class="table">
            <thead>
            <tr>
{{--                <th scope="col">#</th>--}}
                <th scope="col" style="text-align:left">名稱</th>
                <th scope="col" style="text-align:center">新增子類別</th>
                <th scope="col" style="text-align:center">編輯</th>
                <th scope="col" style="text-align:center">刪除</th>
            </tr>
            </thead>
            <tbody>
            @php
                $indexCounter = 1;
            @endphp
            @foreach($curriculumCategories as $index => $curriculumCategory)
                @if($curriculumCategory->parent_id == '0')
                    <tr>
{{--                        <td style="text-align:left">{{ $indexCounter++ }}</td>--}}
                        <td>{{ $curriculumCategory->name }}</td>
                        <td style="text-align:center">
                            <a href="{{ route('admins.curriculum_categories.create_hierarchy',$curriculumCategory->id) }}" class="btn btn-secondary btn-sm">新增子類別</a>
                        </td>
                        <td style="text-align:center">
                            <a href="{{ route('admins.curriculum_categories.edit',$curriculumCategory->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                        </td>
                        <td style="text-align:center">
                            <form id="deleteForm{{ $curriculumCategory->id }}" action="{{ route('admins.curriculum_categories.destroy',$curriculumCategory->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $curriculumCategory->name }}', {{ $curriculumCategory->id }})">刪除</button>
                            </form>
                        </td>
                        <script>
                            function confirmDelete(name, id)
                            {
                                if (confirm("確定要刪除課程分階「" + name + "」嗎？")) {
                                    document.getElementById('deleteForm' + id).submit();
                                }
                            }
                        </script>
                    </tr>
                    {{-- 內層 foreach 顯示子類別 --}}
                    @php
                        $subIndexCounter = 1;
                    @endphp
                    @foreach($curriculumCategories as $subIndex => $subCategory)
                        @if($subCategory->parent_id == $curriculumCategory->id)
                            <tr>
{{--                                <td style="text-align:left">{{ $indexCounter }}.{{ $subIndexCounter++ }}</td>--}}
                                <td style="padding-left: 70px;">{{ $subCategory->name }}</td>
                                <td style="text-align:center">
                                    <a href="{{ route('admins.curriculum_categories.create_hierarchy',$subCategory->id) }}" class="btn btn-secondary btn-sm">新增子類別</a>
                                </td>
                                <td style="text-align:center">
                                    <a href="{{ route('admins.curriculum_categories.edit', $subCategory->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                                </td>
                                <td style="text-align:center">
                                    <form id="deleteForm{{ $subCategory->id }}" action="{{ route('admins.curriculum_categories.destroy', $subCategory->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $subCategory->name }}', {{ $subCategory->id }})">刪除</button>
                                    </form>
                                </td>
                                <script>
                                    function confirmDelete(name, id)
                                    {
                                        if (confirm("確定要刪除課程分階「" + name + "」嗎？")) {
                                            document.getElementById('deleteForm' + id).submit();
                                        }
                                    }
                                </script>
                            </tr>
                            {{-- 第3層的迴圈 --}}
                            @php
                                $thirdIndexCounter = 1;
                            @endphp
                            @foreach($curriculumCategories as $thirdIndex => $thirdCategory)
                                @if($thirdCategory->parent_id == $subCategory->id)
                                    <tr>
{{--                                        <td style="text-align:left">{{ $indexCounter }}.{{ $subIndexCounter }}.{{ $thirdIndexCounter++ }}</td>--}}
                                        <td style="padding-left: 130px;">{{ $thirdCategory->name }}</td>
                                        <td style="text-align:center">
                                            <!-- 如果需要新增第4層的連結，可以在這裡添加 -->
                                        </td>
                                        <td style="text-align:center">
                                            <a href="{{ route('admins.curriculum_categories.edit', $thirdCategory->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                                        </td>
                                        <td style="text-align:center">
                                            <form id="deleteForm{{ $thirdCategory->id }}" action="{{ route('admins.curriculum_categories.destroy', $thirdCategory->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $thirdCategory->name }}', {{ $thirdCategory->id }})">刪除</button>
                                            </form>
                                        </td>
                                        <script>
                                            function confirmDelete(name, id)
                                            {
                                                if (confirm("確定要刪除課程分階「" + name + "」嗎？")) {
                                                    document.getElementById('deleteForm' + id).submit();
                                                }
                                            }
                                        </script>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
