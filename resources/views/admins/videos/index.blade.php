@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.videos.index') }}" class="custom-link"><i class="fa fa-home"></i>法音流佈</a>
        </p>
    </div>
    <h1 class="mt-4">法音流佈</h1>
    <div class="container px-4 px-lg-5 mt-2 mb-4">
        <form action="{{ route('admins.videos.search') }}" method="GET" class="d-flex">
            <select name="category" class="form-select me-2" aria-label="請選擇用標題或類別進行搜尋">
                <option value="title">標題</option>
                <option value="category">類別</option>
            </select>
            <input type="text" name="query" class="form-control me-2" placeholder="請輸入搜尋內容..">
            <button type="submit" class="btn btn-outline-dark">搜尋</button>
        </form>
    </div>
    @if (request()->has('query'))
        <div class="container px-4 px-lg-5 mt-2 mb-4">
            查找「{{ request('query') }}」
            <a class="btn btn-success btn-sm" href="{{ route('admins.videos.index') }}">取消搜尋</a>
        </div>
    @endif
    <a class="btn btn-success btn-sm" href="{{ route('admins.video_categories.index') }}">影音類別</a>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.videos.create') }}">新增影音</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">影音路徑</th>
            <th scope="col" style="text-align:left">影音預覽</th>
            <th scope="col" style="text-align:left">影音標題</th>
            <th scope="col" style="text-align:center">編輯</th>
            <th scope="col" style="text-align:center">刪除</th>
        </tr>
        </thead>
        <tbody>
        @foreach($videos as $index => $video)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>
                <td>{{ $video->video_url }}</td>
                <td>
                    <iframe width="300" height="200" src="https://www.youtube.com/embed/{{ $video->video_id }}" frameborder="0" allowfullscreen></iframe>
                </td>
                <td>{{ $video->video_title }}</td>
                <td style="text-align:center">
                    <a href="{{ route('admins.videos.edit' ,['video' => $video->id]) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm{{ $video->id }}" action="{{ route('admins.videos.destroy',$video->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $video->video_title }}', {{ $video->id }})">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete(videotitle, videoid)
                    {
                        if (confirm("確定要刪除影音「" + videotitle + "」嗎？")) {
                            document.getElementById('deleteForm' + videoid).submit();
                        }
                    }
                </script>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
