@extends('admins.layouts.master')

@section('page-title', 'Article list')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">法音流佈</h1>
    <a class="btn btn-success btn-sm" href="{{ route('admins.video_categories.index') }}">影音類別</a>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('admins.videos.create') }}">新增影音</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" style="text-align:left">影音路徑</th>
            <th scope="col" style="text-align:left">影音標題</th>
        </tr>
        </thead>
        <tbody>
        @foreach($videos as $index => $video)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>
                <div>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video->video_id }}" frameborder="0" allowfullscreen></iframe>
                    <h2>影片標題：{{ $video->video_title }}</h2>
                </div>

                <td>{{ $video->video_url }}</td>
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
