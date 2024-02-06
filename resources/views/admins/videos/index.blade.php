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
            <th scope="col" style="text-align:left">影音描述</th>
        </tr>
        </thead>
        <tbody>
        @foreach($videos as $index => $video)
            <tr>
                <td style="text-align:left">{{ $index + 1 }}</td>

                <td>{{ $video->video_url }}</td>
                <td>{{ $video->video_content }}</td>
                <td style="text-align:center">
                    <a href="{{ route('admins.videos.edit' ,['video' => $video->id]) }}" class="btn btn-secondary btn-sm">編輯</a>
                </td>
                <td style="text-align:center">
                    <form id="deleteForm{{ $video->id }}" action="{{ route('admins.videos.destroy',$video->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $video->video_url }}', {{ $video->id }})">刪除</button>
                    </form>
                </td>
                <script>
                    function confirmDelete(videourl, videoid)
                    {
                        if (confirm("確定要刪除影音「" + videourl + "」嗎？")) {
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
