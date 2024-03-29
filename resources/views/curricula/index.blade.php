@extends('courses.layouts.master')

@section('title','居士學佛')

@section('page-path')
    <div>
        <p style="font-size: 1.2em;">
            <a href="{{ route('home.index') }}" class="custom-link"><i class="fa fa-home"></i></a> &gt;
            居士學佛
        </p>
    </div>
@endsection

@section('content')
    <div class="container px-4 px-lg-5 mt-2 mb-4">
        <form action="{{ route('curricula.search') }}" method="GET" class="d-flex">
            <input type="text" name="query" class="form-control me-2" placeholder="關鍵字搜尋...">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="search_option" id="search_title" value="title" checked>
                <label class="form-check-label" for="search_title">搜尋標題</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="search_option" id="search_content" value="content">
                <label class="form-check-label" for="search_content">搜尋內文</label>
            </div>
            <button type="submit" class="btn btn-outline-dark">搜尋</button>
        </form>
    </div>
    <section class="py-5">
        <div class="container">
            <button id="expandAllBtn" class="btn btn-primary">展開全部</button>&nbsp
            <button id="collapseAllBtn" class="btn btn-primary">收起全部</button><br><br>
            @if(count($categories) > 0)
                <div class="accordion" id="coursesAccordion">
                    @foreach($categories as $category)
                        @if($category->parent_id == 0)
                            <div class="card mb-2">
                                <div class="card-header" id="heading{{ $category->id }}">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link title-link" type="button" data-toggle="collapse" data-target="#collapse{{ $category->id }}" aria-expanded="true" aria-controls="collapse{{ $category->id }}">
                                            {{ $category->name }}
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse{{ $category->id }}" class="collapse" aria-labelledby="heading{{ $category->id }}" data-parent="#coursesAccordion">
                                    <div class="card-body">
                                        @foreach($curricula as $curriculum)
                                            @if($curriculum->curriculum_category_id == $category->id)
                                                <a href="{{ route('curricula.show', $curriculum->id) }}">{{ $curriculum->title }}</a>
                                                <hr>
                                            @endif
                                        @endforeach
                                        @foreach($categories as $childCategory)
                                            @if($childCategory->parent_id == $category->id)
                                                <div class="accordion" id="childAccordion{{ $childCategory->id }}">
                                                    <div class="card">
                                                        <div class="card-header" id="heading{{ $childCategory->id }}">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link title-link" type="button" data-toggle="collapse" data-target="#collapse{{ $childCategory->id }}" aria-expanded="true" aria-controls="collapse{{ $childCategory->id }}">
                                                                    {{ $childCategory->name }}
                                                                </button>
                                                            </h2>
                                                        </div>
                                                        <div id="collapse{{ $childCategory->id }}" class="collapse" aria-labelledby="heading{{ $childCategory->id }}" data-parent="#childAccordion{{ $childCategory->id }}">
                                                            <div class="card-body">
                                                                @foreach($curricula as $curriculum)
                                                                    @if($curriculum->curriculum_category_id == $childCategory->id)
                                                                        <a href="{{ route('curricula.show', $curriculum->id) }}">{{ $curriculum->title }}</a>
                                                                        <hr>
                                                                    @endif
                                                                @endforeach
                                                                @foreach($categories as $grandsonCategory)
                                                                    @if($grandsonCategory->parent_id == $childCategory->id)
                                                                        <div class="accordion" id="childAccordion{{ $grandsonCategory->id }}">
                                                                            <div class="card">
                                                                                <div class="card-header" id="heading{{ $grandsonCategory->id }}">
                                                                                    <h2 class="mb-0">
                                                                                        <button class="btn btn-link title-link" type="button" data-toggle="collapse" data-target="#collapse{{ $grandsonCategory->id }}" aria-expanded="true" aria-controls="collapse{{ $grandsonCategory->id }}">
                                                                                            {{ $grandsonCategory->name }}
                                                                                        </button>
                                                                                    </h2>
                                                                                </div>
                                                                                <div id="collapse{{ $grandsonCategory->id }}" class="collapse" aria-labelledby="heading{{ $grandsonCategory->id }}" data-parent="#childAccordion{{ $grandsonCategory->id }}">
                                                                                    <div class="card-body">
                                                                                        @foreach($curricula as $curriculum)
                                                                                            @if($curriculum->curriculum_category_id == $grandsonCategory->id)
                                                                                                <a href="{{ route('curricula.show', $curriculum->id) }}">{{ $curriculum->title }}</a>
                                                                                                <hr>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div align="center"><p>無課程</p></div>
            @endif
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var hasSearchResults = {{ count($categories) > 0 ? 'true' : 'false' }};

            if (hasSearchResults) {
                var firstButton = document.querySelector('.title-link:first-child');
                var firstCollapse = firstButton.nextElementSibling;

                if (firstCollapse) {
                    firstCollapse.classList.add('show');
                }
            }

            // Add event listener to buttons with the 'title-link' class
            var titleButtons = document.querySelectorAll('.title-link');
            titleButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Get the parent collapse element
                    var parentCollapse = this.nextElementSibling;

                    // Toggle the 'show' class on the parent collapse element
                    parentCollapse.classList.toggle('show');
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // 點擊展開全部按鈕
            document.getElementById('expandAllBtn').addEventListener('click', function() {
                // 遍歷所有折疊面板的父級容器
                var collapseContainers = document.querySelectorAll('.collapse');

                // 對每個父級容器添加展開類別
                collapseContainers.forEach(function(container) {
                    container.classList.add('show');
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // 點擊收起全部按鈕
            document.getElementById('collapseAllBtn').addEventListener('click', function() {
                // 遍歷所有折疊面板的父級容器
                var collapseContainers = document.querySelectorAll('.collapse');

                // 對每個父級容器移除展開的類別
                collapseContainers.forEach(function(container) {
                    container.classList.remove('show');
                });
            });
        });

    </script>
    <style>
        .title-link {
            text-decoration: none;
            color: black;
        }

        a {
            text-decoration:none;
        }
    </style>
@endsection
