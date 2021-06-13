<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Video;
use App\Models\User;
use App\Models\Comments;

class EditorController extends Controller
{


    function __construct()
    {
        $this->middleware(['auth'=>'role:editor']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        return view('videos.index',compact('videos'));
    }

    public function newVideo()
    {
        return view('videos.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=>'required|unique:videos',
            'desc'=>'required',
            'video'=>'required',
        ]);

        $pathV=$request->file('video')->store('videos','public');
        $user = Auth::user()->id;
        Video::create(['title'=>$request->title,
                        'cont'=>$pathV,
                        'desc'=>$request->desc,
                        'user'=>$user,
                        'visitas'=>0
            ]);
        $videos=Video::all();
        return redirect()->route('all');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $videos=Video::FindOrFail($id);
        return view('videos.show',compact('videos'));
    }

    public function allVideos()
    {
        $videos=Video::all();
        return view('videos.all',compact('videos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $videos=Video::FindOrFail($id);
        return view('videos.editE',compact('videos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $videos=Video::FindOrFail($id);
        $videos->update(['title'=>$request->description,
        'desc'=>$request->price
        ]);
        $videos = Video::all();

        return redirect()->route('all');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $com = Comments::where('idVideo',$id);
        $com->delete();
        $video = Video::FindOrFail($id);
        $video->delete();
        return redirect()->route('all');
    }
}
