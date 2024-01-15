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
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form method="POST" action="{{ route('users.comment.store') }}">
                @csrf
                <textarea
                    name="message"
                    placeholder="{{ __('What\'s on your mind?') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >{{ old('message') }}
            </textarea>
                <button class="mt-4">{{ __('留言') }}</button>
            </form>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                @foreach ($post_comment as $post_comment)
                    <div class="p-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $post_comment->user->account }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ $post_comment->created_at->format('j M Y, g:i a') }}</small>
                                    @unless ($post_comment->created_at->eq($post_comment->updated_at))
                                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                    @endunless
                                </div>
                                @if ($post_comment->user->is(auth()->user()))
                                    <div class="p-6 flex space-x-2">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <a href="{{ route('users.comment.edit', $post_comment) }}">
                                            {{ __('Edit') }}
                                        </a>
                                        <form id="delete-comment-form" method="POST" action="{{ route('users.comment.destroy', $post_comment) }}">
                                            @csrf
                                            @method('delete')
                                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-comment-form').submit();">
                                                {{ __('Delete') }}
                                            </a>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $post_comment->message }}</p>
                    </div>
            </div>
            @endforeach
        </div>
    </div>

{{--        <div class ="location-info">--}}

{{--            <h3 class "sub-title">交通資訊</h3>--}}
{{--            <p>--}}
{{--                地址:335桃園市大溪區內柵路一段98巷54-1號<br>--}}
{{--                電話:033883257<br>--}}
{{--            </p>--}}
{{--        </div>--}}
{{--        <div class="location-map">--}}
{{--            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3620.1942296287816!2d121.27671427444545!3d24.85721504538914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3468176912c5eaa7%3A0x46b0f53d5ae5cb0!2z5aSp562R57K-6IiN!5e0!3m2!1szh-TW!2stw!4v1696680829001!5m2!1szh-TW!2stw" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>--}}
{{--        </div>--}}
{{--    </div>--}}

</section>
@endsection
