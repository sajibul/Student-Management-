<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use App\User;
use Storage;
use Image;
use Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $id = Auth::user()->id;
      $data = User::find($id);
      return view('backend.profile.userprofile',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      $this->validate($request,[
        'file'  => 'size:max:500'
      ],[

      ]);

      $userInfo=User::findOrFail($id);
        $image=$request->file('image');
        if(isset($image)){

          $imageName='profile_image_update'.uniqid().'-'.time().'.'.$image->getClientOriginalExtension();

          if(!Storage::disk('public')->exists('profile')){
              Storage::disk('public')->makeDirectory('profile');
          }
          if(Storage::disk('public')->exists('profile/'.$userInfo->image)){
              Storage::disk('public')->delete('profile/'.$userInfo->image);
          }
          Image::make($image)->resize(150,160)->save(public_path('storage/profile/'.$imageName));
        }else{
          $imageName=$userInfo->image;
        }

                $userInfo->name=$request->name;
                $userInfo->username=$request->username;
                $userInfo->email=$request->email;
                $userInfo->mobile=$request->mobile;
                $userInfo->address=$request->address;
                $userInfo->image=$imageName;
                $userInfo->save();
                Toastr::info('Success', 'Data update success');
                return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
