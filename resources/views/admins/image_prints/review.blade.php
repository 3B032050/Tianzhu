@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
    <div class="container-fluid px-4">
        <div style="margin-top: 10px;">
            <p style="font-size: 1.8em;">
                <a href="{{ route('admins.image_prints.index') }}" class="custom-link"><i class="fa fa-home"></i>影印</a> &gt;
                審核
            </p>
        </div>
        <h1 class="mt-4">{{$imagePrint->name}}牌位審核</h1>
        @if($imagePrint->name == '消災')
            <div class="card-footer" style="text-align: center;">
                <a href="{{ route('admins.image_prints.preview', $imagePrint->id) }}" class="btn btn-secondary btn-sm">影印</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="text-align:left">地址</th>
                    <th scope="col" style="text-align:left">姓名</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $index => $user)
                    <tr>
                        <td style="text-align:left">{{ $index + 1 }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->name }}</td>
                        <td style="text-align:center">
                            <a href="{{ route('admins.users.edit',$user->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                        </td>
                        <td style="text-align:center">
                            <form id="deleteForm{{ $user->id }}" action="{{ route('admins.users.destroy',$user->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $user->name }}', {{ $user->id }})">刪除</button>
                            </form>
                        </td>
                        <script>
                            function confirmDelete(username, userId)
                            {
                                if (confirm("確定要刪除使用者「" + username + "」嗎？")) {
                                    document.getElementById('deleteForm' + userId).submit();
                                }
                            }
                        </script>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="d-flex align-items-center">
                    <span class="mr-1">每</span>
                    <select id="records-per-page" class="form-control" onchange="changeRecordsPerPage()">
                        <option value="5" {{ $users->perPage() == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ $users->perPage() == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ $users->perPage() == 20 ? 'selected' : '' }}>20</option>
                    </select>
                    <span class="ml-1">筆</span>
                </div>
            </div>
        @else
            <div class="card-footer" style="text-align: center;">
                <a href="{{ route('admins.image_prints.preview', $imagePrint->id) }}" class="btn btn-secondary btn-sm">影印</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="text-align:left">地址</th>
                    <th scope="col" style="text-align:left">超薦人</th>
                    <th scope="col" style="text-align:left">陽上人</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $index => $user)
                    <tr>
                        <td style="text-align:left">{{ $index + 1 }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->name }}</td>
                        <td style="text-align:center">
                            <a href="{{ route('admins.users.edit',$user->id) }}" class="btn btn-secondary btn-sm">編輯</a>
                        </td>
                        <td style="text-align:center">
                            <form id="deleteForm{{ $user->id }}" action="{{ route('admins.users.destroy',$user->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $user->name }}', {{ $user->id }})">刪除</button>
                            </form>
                        </td>
                        <script>
                            function confirmDelete(username, userId)
                            {
                                if (confirm("確定要刪除使用者「" + username + "」嗎？")) {
                                    document.getElementById('deleteForm' + userId).submit();
                                }
                            }
                        </script>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="d-flex align-items-center">
                    <span class="mr-1">每</span>
                    <select id="records-per-page" class="form-control" onchange="changeRecordsPerPage()">
                        <option value="5" {{ $users->perPage() == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ $users->perPage() == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ $users->perPage() == 20 ? 'selected' : '' }}>20</option>
                    </select>
                    <span class="ml-1">筆</span>
                </div>
            </div>
        @endif
        <div class="d-flex justify-content-center">
            @if ($users->currentPage() > 1)
                <a href="{{ $users->previousPageUrl() }}" class="btn btn-secondary">上一頁</a>
            @endif

            <span class="mx-2">全部 {{ $users->total() }} 筆資料，目前位於第 {{ $users->currentPage() }} 頁，共 {{ $users->lastPage() }} 頁</span>

            @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}" class="btn btn-secondary">下一頁</a>
            @endif
        </div>
    </div>
    <script>
        function changeRecordsPerPage() {
            const select = document.getElementById('records-per-page');
            const value = select.options[select.selectedIndex].value;
            window.location.href = `{{ route('admins.users.index') }}?perPage=${value}`;
        }
    </script>
@endsection
