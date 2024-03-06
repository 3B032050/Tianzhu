@extends('courses.layouts.master')

@section('title','課程顯示')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            <a href="{{ route('courses.overview') }}" class="custom-link">僧伽教育</a> &gt;
            {{ $selectedCategory->name }}
        </p>
    </div>
@endsection

@section('content')
    <div class="container px-4 px-lg-5 mt-2 mb-4">
        <form action="{{ route('courses.by_category_search', $selectedCategory->id) }}" method="GET">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="query" class="form-control me-2" placeholder="關鍵字搜尋...">
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-outline-dark">搜尋</button>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="search_type" id="searchTitle" value="title" checked>
                        <label class="form-check-label" for="searchTitle">搜尋標題</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="search_type" id="searchContent" value="content">
                        <label class="form-check-label" for="searchContent">搜尋內文</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2>{{ $selectedCategory->name }}</h2>
            </div>

            @if(count($selectedCategory->courses) > 0)
                <div class="accordion" id="coursesAccordion" style="max-width: 960px; margin: 0 auto;">
                    @foreach($selectedCategory->courses as $course)
                        <div class="card">
                            <div class="card-header" id="courseHeading{{ $course->id }}">
                                <h2 class="mb-0">
                                    <button class="btn btn-link title-link" type="button" data-toggle="collapse" data-target="#courseCollapse{{ $course->id }}" aria-expanded="true" aria-controls="courseCollapse{{ $course->id }}">
                                        {{ $course->title }}
                                    </button>
                                </h2>
                            </div>

                            <div id="courseCollapse{{ $course->id }}" class="collapse" aria-labelledby="courseHeading{{ $course->id }}" data-parent="#coursesAccordion">
                                <div class="card-body text-start">
                                    <p class="card-text">
                                        授課方式<br>
                                        @foreach($course->methods as $index => $method)
                                            {{ ($index+1) }}
                                            {{ $method->name }}<br>
                                        @endforeach
                                    </p>
                                    <p class="card-text">
                                        授課目標<br>
                                        @foreach($course->objectives as $objective)
                                            {{ $objective->description }}<br>
                                        @endforeach
                                    </p>
                                    @if ($course->note)
                                        <p class="card-text">備註：{{ $course->note }}</p>
                                    @endif
                                    @if ($course->time)
                                        <p class="card-text">時間：{{ $course->time }}</p>
                                    @endif
                                    @if ($course->content)
                                        <a href="{{ route('courses.show',['course_category' => $selectedCategory->id, 'course' => $course->id]) }}" class="btn btn-secondary">課程內容檢視</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div align="center"><p>無課程</p></div>
            @endif
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var hasSearchResults = {{ count($selectedCategory->courses) > 0 ? 'true' : 'false' }};

            if (hasSearchResults) {
                var firstCourse = document.querySelector('.card:first-child');
                var firstCollapse = firstCourse.querySelector('.collapse');

                if (firstCollapse) {
                    firstCollapse.classList.add('show');
                }
            }
        });
    </script>
    <style>
        .title-link {
            text-decoration: none;
            color: black;
        }
    </style>
@endsection
