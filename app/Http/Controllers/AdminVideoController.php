<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Video_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AdminVideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('id', 'ASC')->get();
        $data = ['videos' => $videos];
        return view('admins.videos.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $video_categories = Video_category::get();
        $data = [
            'video_categories' =>$video_categories,
            ];
        return view('admins.videos.create',$data);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'video_category_id' => 'required',
            'video_url' => 'required',
            'video_title'=> 'required',

        ]);
        // 獲取用戶提交連接
        $videourl = $request->input('video_url');

        // 從連接提取影品id
        $videoId = $this->extractVideoId($videourl);

        // 發送請請到 YouTube Data API 獲取影品訊息
        $response = Http::get('https://www.googleapis.com/youtube/v3/videos', [
            'part' => 'snippet',
            'id' => $videoId,
            'key' => env('YOUTUBE_API_KEY')
        ]);

        // 解析 API 響應
        $videoInfo = $response->json();

        // 提取影品封面片連接
        $coverUrl = $videoInfo['items'][0]['snippet']['thumbnails']['high']['url'];
        // 構件包含所有數據的字組
        Video::create([
            'video_category_id' => $request->input('video_category_id'),
            'video_url' => $videourl,
            'video_id'=>$videoId,
            'cover_url' => $coverUrl,
            'video_title'=>$request->video_title,
        ]);
        return redirect()->route('admins.videos.index');
    }
    public function edit(Video $video)
    {
        $video_categories = Video_category::orderby('id','ASC')->get();
        $data = [
            'video'=> $video,'video_categories'=>$video_categories,
        ];
        return view('admins.videos.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $this->validate($request,[
            'video_category_id' => 'required',
            'video_url' => 'required',
            'video_title'=> 'required',
        ]);
        // 獲取用戶提交連接
        $videourl = $request->input('video_url');

        // 從連接提取影品id
        $videoId = $this->extractVideoId($videourl);

        // 發送請請到 YouTube Data API 獲取影品訊息
        $response = Http::get('https://www.googleapis.com/youtube/v3/videos', [
            'part' => 'snippet',
            'id' => $videoId,
            'key' => env('YOUTUBE_API_KEY')
        ]);

        // 解析 API 響應
        $videoInfo = $response->json();

        // 提取影品封面片連接
        $coverUrl = $videoInfo['items'][0]['snippet']['thumbnails']['high']['url'];

        $video->update([
            'video_category_id' => $request->input('video_category_id'),
            'video_url' => $videourl,
            'video_id' => $videoId,
            'cover_url' => $coverUrl,
            'video_title' => $request->input('video_title'),
        ]);

        return redirect()->route('admins.videos.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admins.videos.index');
    }
    public function extractVideoId($videourl)
    {
        // 獲取影片id
        if (Str::contains($videourl, 'youtube.com')) {
            // 如果链接中包含 youtube.com，则從 URL 中提取影片 ID
            $parts = parse_url($videourl);
            parse_str($parts['query'], $query);
            return $query['v'];
        } elseif (Str::contains($videourl, 'youtu.be')) {
            // 如果链接中包含 youtu.be，则從URL 中提取影片 ID
            $parts = explode('/', $videourl);
            return end($parts);
        } else {
            return null;
        }
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $category = $request->input('category');
        $perPage = $request->input('perPage', 10);

        $query = Video::with('video_category');

        if ($category == 'title') {
            $query->where('video_title', 'like', "%$searchTerm%");
        } elseif ($category == 'category') {
            $query->whereHas('video_category', function ($query) use ($searchTerm) {
                $query->where('category_name', 'like', "%$searchTerm%");
            });
        }

        $coursefiles = $query->orderBy('id', 'ASC')->paginate($perPage);

        return view('admins.videos.index', [
            'videos' => $coursefiles,
            'query' => $searchTerm,
            'category' => $category,
        ]);
    }
}
