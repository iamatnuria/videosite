<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\User;
use App\Models\Comments;

class AdminController extends Controller
{

    function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        $users = User::all();
        return view('videos.index',compact('videos','users'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::FindOrFail($id);
        return view('user.edit',compact('user'));
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
        return view('videos.edit',compact('videos'));
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

        //return view('videos.index',compact('videos'));
        return redirect()->route('edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comments = Comments::where('idVideo',$id);
        $comments->delete();
        $video = Video::FindOrFail($id);
        $video->delete();
        return redirect()->route('all');
    }
}
