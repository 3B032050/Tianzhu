<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{ route('admins.home.index') }}">
                    主控台
                </a>
{{--                <a class="nav-link" href="{{ route('admins.web_hierarchies.index') }}">--}}
{{--                    主網頁階層設定--}}
{{--                </a>--}}

{{--                # 外標題 --}}
{{--                <div class="sb-sidenav-menu-heading">介面</div>--}}

{{--                # 單層--}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    天筑精舍簡介
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admins.introductions.index') }}">檢視簡介</a>
                    </nav>
                </div>

{{--                # 層中層 --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCourses" aria-expanded="false" aria-controls="collapseCourses">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    僧伽教育
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCourses" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="{{ route('admins.courses.index') }}">檢視所有課程</a>
                        <a class="nav-link" href="{{ route('admins.course_overviews.edit') }}">編輯總覽</a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#coursesCollapseCategories" aria-expanded="false" aria-controls="coursesCollapseCategories">
                            課程分階
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="coursesCollapseCategories" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admins.course_categories.index') }}">檢視所有分階</a>
                                <a class="nav-link" href="{{ route('admins.course_categories.create') }}">新增課程分階</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#coursesCollapseMethods" aria-expanded="false" aria-controls="coursesCollapseMethods">
                            課程方式
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="coursesCollapseMethods" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admins.course_methods.index') }}">檢視所有方式</a>
                                <a class="nav-link" href="{{ route('admins.course_methods.create') }}">新增課程方式</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#coursesCollapseObjectives" aria-expanded="false" aria-controls="coursesCollapseObjectives">
                            課程目標
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="coursesCollapseObjectives" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admins.course_objectives.index') }}">檢視所有目標</a>
                                <a class="nav-link" href="{{ route('admins.course_objectives.create') }}">新增課程目標</a>
                            </nav>
                        </div>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCurricula" aria-expanded="false" aria-controls="collapseCurricula">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-book-open-reader"></i></div>
                    居士學佛
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCurricula" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="{{ route('admins.curricula.index') }}">檢視所有課程</a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#curriculaCollapseCategories" aria-expanded="false" aria-controls="curriculaCollapseCategories">
                            課程分類
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="curriculaCollapseCategories" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admins.curriculum_categories.index') }}">檢視所有分類</a>
                                <a class="nav-link" href="{{ route('admins.curriculum_categories.create') }}">新增課程分類</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#curriculaCollapseMethods" aria-expanded="false" aria-controls="curriculaCollapseMethods">
                            課程方式
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="curriculaCollapseMethods" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admins.curriculum_categories.index') }}">檢視所有方式</a>
                                <a class="nav-link" href="{{ route('admins.curriculum_categories.create') }}">新增課程方式</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#curriculaCollapseObjectives" aria-expanded="false" aria-controls="curriculaCollapseObjectives">
                            課程目標
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="curriculaCollapseObjectives" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admins.curriculum_categories.index') }}">檢視所有目標</a>
                                <a class="nav-link" href="{{ route('admins.curriculum_categories.create') }}">新增課程目標</a>
                            </nav>
                        </div>
                    </nav>
                </div>


                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCommonSenses" aria-expanded="false" aria-controls="collapseCommonSenses">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-chalkboard"></i></div>
                    佛門小常識
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCommonSenses" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="{{ route('admins.common_senses.index') }}">檢視所有小常識</a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#commonSensesCollapseCategories" aria-expanded="false" aria-controls="commonSensesCollapseCategories">
                            小常識分類
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="commonSensesCollapseCategories" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admins.common_sense_categories.index') }}">檢視所有分類</a>
                                <a class="nav-link" href="{{ route('admins.common_sense_categories.create') }}">新增小常識分類</a>
                            </nav>
                        </div>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCourseFiles" aria-expanded="false" aria-controls="collapseCourseFiles">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-newspaper"></i></div>
                    課程講義
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCourseFiles" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="{{ route('admins.course_file.index') }}">檢視所有講義</a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#courseFilesCollapseCategories" aria-expanded="false" aria-controls="courseFilesCollapseCategories">
                            小常識分類
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="courseFilesCollapseCategories" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admins.course_file_categories.index') }}">檢視所有分類</a>
                                <a class="nav-link" href="{{ route('admins.course_file_categories.create') }}">新增講義分類</a>
                            </nav>
                        </div>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVideos" aria-expanded="false" aria-controls="collapseVideos">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-video"></i></div>
                    法音流布
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseVideos" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="{{ route('admins.videos.index') }}">檢視所有影音</a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#videosCollapseCategories" aria-expanded="false" aria-controls="videosCollapseCategories">
                            影音分類
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="videosCollapseCategories" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admins.video_categories.index') }}">檢視所有分類</a>
                                <a class="nav-link" href="{{ route('admins.video_categories.create') }}">新增影音分類</a>
                            </nav>
                        </div>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseActivities" aria-expanded="false" aria-controls="collapseActivities">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                    活動紀實
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseActivities" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="{{ route('admins.activities.index') }}">檢視所有活動</a>
{{--                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#activitiesCollapseCategories" aria-expanded="false" aria-controls="activitiesCollapseCategories">--}}
{{--                            活動分類--}}
{{--                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>--}}
{{--                        </a>--}}
{{--                        <div class="collapse" id="activitiesCollapseCategories" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">--}}
{{--                            <nav class="sb-sidenav-menu-nested nav">--}}
{{--                                <a class="nav-link" href="{{ route('admins.activity_categories.index') }}">檢視所有分類</a>--}}
{{--                                <a class="nav-link" href="{{ route('admins.activity_categories.create') }}">新增影音分類</a>--}}
{{--                            </nav>--}}
{{--                        </div>--}}
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePosts" aria-expanded="false" aria-controls="collapsePosts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-signs-post"></i></div>
                    公告管理
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePosts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admins.posts.index') }}">檢視所有公告</a>
                        <a class="nav-link" href="{{ route('admins.posts.create') }}">新增公告</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSlides" aria-expanded="false" aria-controls="collapseSlides">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-image"></i></div>
                    幻燈片管理
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseSlides" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admins.slides.index') }}">檢視所有幻燈片</a>
                        <a class="nav-link" href="{{ route('admins.slides.create') }}">新增幻燈片</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseImagePrints" aria-expanded="false" aria-controls="collapseImagePrints">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-download"></i></div>
                    圖片輸出
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseImagePrints" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admins.image_prints.index') }}">檢視所有圖片</a>
                        <a class="nav-link" href="{{ route('admins.image_prints.create') }}">新增圖片</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    用戶管理
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseUsers" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="{{ route('admins.users.index') }}">檢視所有用戶</a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#usersCollapseClassifications" aria-expanded="false" aria-controls="usersCollapseClassifications">
                            用戶類別
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="usersCollapseClassifications" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admins.user_classifications.index') }}">檢視所有分類</a>
                                <a class="nav-link" href="{{ route('admins.user_classifications.create') }}">新增用戶分類</a>
                            </nav>
                        </div>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmins" aria-expanded="false" aria-controls="collapseAdmins">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>
                    管理員管理
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAdmins" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="{{ route('admins.admins.index') }}">檢視所有管理員</a>
{{--                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#usersCollapseClassifications" aria-expanded="false" aria-controls="usersCollapseClassifications">--}}
{{--                            管理員權限--}}
{{--                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>--}}
{{--                        </a>--}}
{{--                        <div class="collapse" id="usersCollapseClassifications" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">--}}
{{--                            <nav class="sb-sidenav-menu-nested nav">--}}
{{--                                <a class="nav-link" href="{{ route('admins.user_classifications.index') }}">檢視所有分類</a>--}}
{{--                                <a class="nav-link" href="{{ route('admins.user_classifications.create') }}">新增用戶分類</a>--}}
{{--                            </nav>--}}
{{--                        </div>--}}
                    </nav>
                </div>
            </div>
        </div>
{{--        <div class="sb-sidenav-footer">--}}
{{--            後台資料管理--}}
{{--        </div>--}}
    </nav>
</div>
