@extends('layouts.master')

@section('title','天筑精舍')

@section('content')
<section id="location">
    <div class="wrapper mx-auto" style="text-align:center">
        <div class ="table">
            <table class="table" style="text-align:center">
                <thead>
                <tr>
                    <th scope="col">公告標題</th>
                    <th scope="col">公告內容</th>
                    <th scope="col">公告附檔</th>
                    <th scope="col">公告時間</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td>
                        <a href="{{ route('post_download', ['id' => $post->id, 'file' => $post->file]) }}">
                            {{ $post->file }}
                        </a>
                    </td>
                    <td>{{ $post->created_at }}</td>
                </tr>
                <!-- 可以添加更多的 <tr> 来显示其他的帖子 -->
                </tbody>
            </table>
        </div>
        <div class ="location-info">

            <h3 class "sub-title">交通資訊</h3>
            <p>
                地址:335桃園市大溪區內柵路一段98巷54-1號<br>
                電話:033883257<br>
            </p>
        </div>
        <div class="location-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3620.1942296287816!2d121.27671427444545!3d24.85721504538914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3468176912c5eaa7%3A0x46b0f53d5ae5cb0!2z5aSp562R57K-6IiN!5e0!3m2!1szh-TW!2stw!4v1696680829001!5m2!1szh-TW!2stw" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>
@endsection
