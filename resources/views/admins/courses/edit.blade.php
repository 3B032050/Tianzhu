@extends('admins.layouts.master')

@section('page-title', 'Edit article')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.courses.index') }}" class="custom-link"><i class="fa fa-home"></i>僧伽教育</a> &gt;
            編輯課程 - {{ $course->title }}
        </p>
    </div>
    @include('admins.layouts.shared.errors')
    <form action="{{ route('admins.courses.update',$course->id) }}" method="POST" role="form">
        @method('PATCH')
        @csrf

        <div class="form-group">
            <label for="title" class="form-label">課程名稱</label>
            <input id="title" name="title" type="text" class="form-control" value="{{ old('title',$course->title) }}" placeholder="請輸入姓名">
        </div>

        <div class="form-group">
            <label for="method" class="form-label">類別</label>
            <input id="method" name="method" type="text" class="form-control" value="{{ old('method',$course->method) }}" placeholder="非必填">
        </div>

        <div class="form-group">
            <label for="course_category">課程分階</label>
            <select name="course_category" id="course_category" class="form-select">
                @foreach($course_categories as $category)
                    <option value="{{ $category->id }}" {{ ($category->id == $course->course_category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="course_methods">方法</label>
            @foreach($course_methods as $method)
                <div class="form-check">
                    <input type="checkbox" name="course_methods[]" id="method_{{ $method->id }}" value="{{ $method->id }}" class="form-check-input" {{ (in_array($method->id, $selectedMethods)) ? 'checked' : '' }}>
                    <label for="method_{{ $method->id }}" class="form-check-label">{{ $method->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="course_objectives">目標</label>
            @foreach($course_objectives as $objective)
                <div class="form-check">
                    <input type="checkbox" name="course_objectives[]" id="objective_{{ $objective->id }}" value="{{ $objective->id }}" class="form-check-input" {{ (in_array($objective->id, $selectedObjectives)) ? 'checked' : '' }}>
                    <label for="objective_{{ $objective->id }}" class="form-check-label">{{ $objective->description }}</label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="time" class="form-label">時間</label>
            <input id="time" name="time" type="text" class="form-control" value="{{ old('time',$course->time) }}" placeholder="非必填">
        </div>
        <div class="form-group">
            <label for="note" class="form-label">備註</label>
            <input id="note" name="note" type="text" class="form-control" value="{{ old('note',$course->note) }}" placeholder="非必填">
        </div>
        <div class="form-group">
            <label for="content" class="form-label">內容</label>
            <textarea id="editor" name="content" class="form-control">{!! old('content', $course->content) !!}</textarea>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <div class="me-4">
                <button type="submit" name="status" value="0" class="btn btn-primary btn-sm">暫存課程</button>
            </div>
            <div>
                <button type="submit" name="status" value="1" class="btn btn-primary btn-sm">立即發佈</button>
            </div>
        </div>
    </form>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/translations/zh.js"></script>
<script>
    CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
        toolbar: {
            items: [
                'exportPDF','exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        language: 'zh',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: '輸入文字...',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                '預設字體',
                '微軟正黑體, Arial, sans-serif',
                '標楷體, PMingLiU, sans-serif',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif',
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        // The "superbuild" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'AIAssistant',
            'CKBox',
            'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
            'MathType',
            // The following features are part of the Productivity Pack and require additional license.
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents',
            'PasteFromOfficeEnhanced',
            'CaseChange'
        ],
        ckfinder: {
            uploadUrl: '{{route('admins.courses.upload').'?_token='.csrf_token()}}',
        },
    });
</script>
@endsection
