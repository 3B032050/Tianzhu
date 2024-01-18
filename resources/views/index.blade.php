@extends('layouts.master')

@section('title','天筑精舍')

@section('content')


    @if($slides->count() > 0)
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($slides as $index => $slide)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/slides/' . $slide->image_path) }}?v={{ time() }}" class="d-block w-100" alt="{{ $slide->title }}" style="width: 80vw; height: 500px; object-fit: cover;">
                    </div>
                @endforeach
            </div>
            <!-- 轮播控制按钮 -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <br><br>
    @else
        <!-- 如果沒有幻燈片，顯示預設的圖片 -->
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/1705423957.jpg') }}?v={{ time() }}" class="d-block w-100" style="width: 80vw; height: 500px; object-fit: cover;">
                </div>
            </div>
            <!-- 轮播控制按钮 -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <br><br>
    @endif

    <div class="wrapper mx-auto" style="text-align:center">
        <div class ="table">
            <table class="table"  style="text-align:center">
                <thead>
                <tr>
                    <th scope="col" style="text-align:center">標題</th>

                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td style="text-align:center">
                            <a href="{{ route('show', $post->id) }}">{{ $post->title }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>



{{--        <div class ="location-info">--}}

{{--            <h3 class= "sub-title">交通資訊</h3>--}}
{{--            <p>--}}
{{--                地址:335桃園市大溪區內柵路一段98巷54-1號<br>--}}
{{--                電話:033883257<br>--}}
{{--            </p>--}}
{{--        </div>--}}
{{--        <div class="location-map">--}}
{{--            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3620.1942296287816!2d121.27671427444545!3d24.85721504538914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3468176912c5eaa7%3A0x46b0f53d5ae5cb0!2z5aSp562R57K-6IiN!5e0!3m2!1szh-TW!2stw!4v1696680829001!5m2!1szh-TW!2stw" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>--}}
{{--        </div>--}}

<script>
    var myCarousel = new bootstrap.Carousel(document.getElementById('carouselExampleControls'), {
        interval: 3200,  // 调整切换间隔时间
        wrap: true,
    });
</script>
@endsection
