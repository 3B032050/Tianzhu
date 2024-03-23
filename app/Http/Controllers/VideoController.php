<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::join('video_categories', 'videos.video_category_id', '=', 'video_categories.id')
            ->orderBy('video_categories.order_category_id', 'ASC')
            ->orderBy('videos.order_video_id', 'ASC')
            ->get();
        $data = ['videos' => $videos];
        return view('videos.index', $data);
    }
    public static function join($table1, $column1, $operator, $table2, $column2, $type = 'inner')
    {
        return DB::table($table1)
            ->join($table2, $column1, $operator, $column2, $type)
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        //
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

        return view('videos.index', [
            'videos' => $coursefiles,
            'query' => $searchTerm,
            'category' => $category,
        ]);
    }
}
