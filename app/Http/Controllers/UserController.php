<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Video;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'min:3|max:32',
            'email' => 'min:10|max:32',
            'id',
        ]);

        $user = User::FindOrFail($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back();
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
            'name' => 'min:3|max:32',
            'email' => 'min:10|max:32',
            'id',
        ]);

        $user = User::FindOrFail($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        $videos = Video::where('user',$user->id)->get();
        return view('user.profile',compact('user','videos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::FindOrFail($id);
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:3|max:32',
            'id',
        ]);

        $user = User::FindOrFail($request->id);
        $password = bcrypt($request->password);

        $user->password = $password;
        $user->save();

        return redirect()->back()->withSuccess('Password actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comments = Comments::where('user',$id);
        $comments->delete();
        $user = User::FindOrFail($id);
        $user->delete();
        return redirect()->route('all');
    }
}
