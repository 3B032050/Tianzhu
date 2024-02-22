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
        <form action="" method="GET" class="d-flex">
            <input type="text" name="query" class="form-control me-2" placeholder="關鍵字搜尋...">
            <button type="submit" class="btn btn-outline-dark">搜尋</button>
        </form>
    </div>
    <section class="py-5">
        <div class="container">

            @if(count($categories) > 0)
                <div class="accordion" id="coursesAccordion" style="max-width: 960px; margin: 0 auto;">
                    @foreach($categories as $category)
                        @if($category->parent_id == 0)
                            <h2 class="mb-0">
                                <button class="btn btn-link title-link" type="button" data-toggle="collapse" data-target="#courseCollapse{{ $category->id }}" aria-expanded="true" aria-controls="courseCollapse{{ $category->id }}">
                                    {{ $category->name }}
                                </button>
                            </h2>
                            <hr>
                                <div id="courseCollapse{{ $category->id }}" class="collapse" aria-labelledby="courseHeading{{ $category->id }}" data-parent="#coursesAccordion">
                                    <div class="card-body text-start">
                                        @foreach($categories as $childCategory)
                                            @if($childCategory->parent_id == $category->id)
                                                <div class="card">

                                                        @if(isset($childCategory->children) && !empty($childCategory->children))
                                                            <button class="btn btn-link title-link" type="button" data-toggle="collapse" data-target="#courseCollapse{{ $childCategory->id }}" aria-expanded="true" aria-controls="courseCollapse{{ $childCategory->id }}">
                                                                {{ $childCategory->name }}
                                                            </button>
                                                        @else
                                                            {{ $childCategory->name }}
                                                        @endif

                                                    <div id="courseCollapse{{ $childCategory->id }}" class="collapse" aria-labelledby="courseHeading{{ $childCategory->id }}" data-parent="#courseCollapse{{ $category->id }}">
                                                        <div class="card-body text-start">
                                                            @foreach($categories as $grandChildCategory)
                                                                @if($grandChildCategory->parent_id == $childCategory->id)
                                                                    <p>{{ $grandChildCategory->name }}</p>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
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
                var firstCourse = document.querySelector('.card:first-child');
                var firstCollapse = firstCourse.querySelector('.collapse');

                if (firstCollapse) {
                    firstCollapse.classList.add('show');
                }
            }

            // Add event listener to buttons with the 'title-link' class
            var titleButtons = document.querySelectorAll('.title-link');
            titleButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Get the parent collapse element
                    var parentCollapse = this.closest('.card-header').nextElementSibling;

                    // Toggle the 'show' class on the parent collapse element
                    parentCollapse.classList.toggle('show');
                });
            });
        });
    </script>
    <style>
        .title-link {
            text-decoration: none;
            color: black;
        }
    </style>
@endsection
