@extends('admins.layouts.master')

@section('page-title', 'Create article')

@section('page-content')
<div class="container-fluid px-4">
    <div style="margin-top: 10px;">
        <p style="font-size: 1.8em;">
            <a href="{{ route('admins.posts.index') }}" class="custom-link"><i class="fa fa-home"></i>公告管理</a> &gt;
            新增公告
        </p>
    </div>
    <h1 class="mt-4">文章管理</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">新增文章</li>
    </ol>
    @include('admins.layouts.shared.errors')
    <form action="{{ route('admins.posts.store') }}" method="POST" role="form" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="form-group">
            <label for="title" class="form-label">文章標題</label>
            <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" placeholder="請輸入文章標題">
        </div>
        <div class="form-group">
            <label for="content" class="form-label">文章內容</label>
            <textarea id="editor" name="content" class="form-control">{{ old('content')}}</textarea>
        </div>
        <div class="form-group">
            <label for="file" class="form-label">上傳檔案</label>
            <input id="file" name="file" type="file" class="form-control" rows="10" placeholder="附檔"></input>
        </div>
        <div class="form-group">
            <label for="is_feature" class="form-label">精選?</label>
            <select id="is_feature" name="is_feature" class="form-control">
                <option value="0">否</option>
                <option value="1">是</option>
            </select>
        </div>
        <div class="form-group">
            <label for="announce_date" class="form-label">公告時間</label>
            <input id="announce_date" name="announce_date" type="date" class="form-control" rows="10" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></input>
        </div>
        <div class="button-container">
            <div id="publish_button" style="display: block;" class="publish-button">
                <button type="submit" name="status" value="1" class="btn btn-primary btn-sm">直接發佈</button>
            </div>
            <div class="save-button">
                <button type="submit" name="status" value="0" class="btn btn-primary btn-sm">儲存</button>
            </div>
        </div>
    </form>
</div>
    <script>
        document.getElementById('announce_date').addEventListener('change', function() {
            var selectedDate = new Date(this.value);
            var currentday = new Date();
            if (selectedDate.getTime() === currentday.getTime()) {
                document.getElementById('publish_button').style.display = 'block';
            } else {
                document.getElementById('publish_button').style.display = 'none';
            }
        });
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/translations/zh.js"></script>
    <script type="module">
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
            extraAllowedContent:  'img[alt,border,width,height,align,vspace,hspace,!src];',
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
                uploadUrl: '{{route('admins.introductions.upload').'?_token='.csrf_token()}}',
            },
        })
            .catch(error => {
                console.error(error);
            });
    </script>
<style>
    .button-container {
        display: flex;
        justify-content: flex-end;
    }

    .publish-button, .save-button {
        margin-left: 10px; /* 在按鈕之間增加間距 */
    }
</style>
@endsection
