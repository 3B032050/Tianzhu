@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">居士學佛</h1>
        <a class="btn btn-success btn-sm" href="{{ route('admins.curriculum_categories.index') }}">課程類別</a>
        <a class="btn btn-success btn-sm" href="{{ route('admins.curriculum_methods.index') }}">課程方式</a>
        <a class="btn btn-success btn-sm" href="{{ route('admins.curriculum_objectives.index') }}">課程目標</a><br><br>
        <form action="{{ route('admins.curricula.store') }}" method="POST" role="form">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="curriculum_category">選擇課程類別</label>
                <select name="curriculum_category" id="curriculum_category" class="form-select" onchange="navigateToRoute(this.value)">
                    <option value="" selected disabled>請選擇類別</option>
                    @foreach($curriculumCategories as $curriculumCategory)
                        @if($curriculumCategory->parent_id == 0)
                            <option value="{{ route('admins.curricula.selected',$curriculumCategory->id) }}">{{ $curriculumCategory->name }}</option>
                            @foreach($curriculumCategories as $subCategory)
                                @if($subCategory->parent_id == $curriculumCategory->id)
                                    <option value="{{ route('admins.curricula.selected',$subCategory->id) }}">&nbsp&nbsp&nbsp&nbsp{{ $subCategory->name }}</option>
                                    @foreach($curriculumCategories as $thirdCategory)
                                        @if($thirdCategory->parent_id == $subCategory->id)
                                            <option value="{{ route('admins.curricula.selected',$thirdCategory->id) }}">&nbsp&nbsp&nbsp&nbsp&nbsp{{ $thirdCategory->name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </select>
            </div><br><br>
        </form>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('admins.curricula.create') }}">新增課程</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 8%; text-align:left">類別</th>
                <th scope="col" style="width: 10%; text-align:left">課程名稱</th>
                <th scope="col" style="width: 15%; text-align:left">方式</th>
                <th scope="col" style="width: 15%; text-align:left">目標</th>
                <th scope="col" style="width: 13%; text-align:left">最新修改管理員</th>
                <th scope="col" style="width: 8%; text-align:left">狀態</th>
                <th scope="col" style="text-align:center">發佈</th>
                <th scope="col" style="text-align:center">編輯</th>
                <th scope="col" style="text-align:center">刪除</th>
            </tr>
            </thead>
            <tbody>
            @foreach($curricula as $index => $curriculum)
                <tr>
                    <td style="text-align:left">{{ $index + 1 }}</td>
                    <td>
                        @if ($curriculum->category)
                            {{ $curriculum->category->name }}
                        @else
                            未分類
                        @endif
                    </td>
                    <td>{{ $curriculum->title }}</td>
                    <td>
                        @foreach($curriculum->methods as $index_method => $method)
                            {{ $index_method + 1 }}
                            {{ $method->name }}
                            @if(!$loop->last)
                                <br>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($curriculum->objectives as $index_objective => $objective)
                            {{ $index_objective + 1 }}
                            {{ $objective->description }}
                            @if(!$loop->last)
                                <br>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if($curriculum->lastModifiedByAdmin)
                            {{ $curriculum->lastModifiedByAdmin->user->name }}
                        @else
                            無
                        @endif
                    </td>
                    <td>
                        @if ($curriculum->status == 0)
                            <div style="color:#ff3370; font-weight:bold;">
                                (未發布)
                            </div>
                        @else
                            <div style="color:#ffa600; font-weight:bold;">
                                (已發佈)
                            </div>
                        @endif
                    </td>
                    <td style="text-align:center">
                        @if ($curriculum->status == 0)
                            <form action="{{ route('admins.curricula.status_on',$curriculum->id) }}" method="POST" role="form">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm">發佈</button>
                            </form>
                        @else
                            <form action="{{ route('admins.curricula.status_off',$curriculum->id) }}" method="POST" role="form">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm">取消發佈</button>
                            </form>
                        @endif
                    </td>
                    <td style="text-align:center">
                        <a href="{{ route('admins.curricula.edit',$curriculum->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                    </td>
                    <td style="text-align:center">
                        <form id="deleteForm{{ $curriculum->id }}" action="{{ route('admins.curricula.destroy',$curriculum->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $curriculum->title }}', {{ $curriculum->id }})">刪除</button>
                        </form>
                    </td>
                    <script>
                        function confirmDelete(coursetitle, courseId)
                        {
                            if (confirm("確定要刪除課程「" + coursetitle + "」嗎？")) {
                                document.getElementById('deleteForm' + courseId).submit();
                            }
                        }
                    </script>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

<script>
    function navigateToRoute(selectedUserId) {
        if (selectedUserId) {
            window.location.href = selectedUserId;
        }
    }
</script>
