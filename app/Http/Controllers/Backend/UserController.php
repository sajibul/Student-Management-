<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use App\User;
use App\Role;
use Storage;
use Image;
use Auth;
class UserController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('admin');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = User::all();
      return view('backend.users.alluser',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $role = Role::all();
      return view('backend.users.adduser',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
        'role'=>'required',
        'name'=>'required',
        'username'=>'required',
        'email'=>'required|unique:users',
        'phone'=>'required',
        'address'=>'required',
        'file'  => 'size:max:100',
        'password'=>'required|confirmed',
    ],[

    ]);


    if($request->hasFile('image')){
          $image=$request->file('image');
          $imageName='profile_image-'.uniqid().'-'.time().'.'.$image->getClientOriginalExtension();
          if(!Storage::disk('public')->exists('profile')){
              Storage::disk('public')->makeDirectory('profile');
          }
          Image::make($image)->resize(500,479)->save(public_path('storage/profile/'.$imageName));
        }else{
          $imageName="default.png";
        }

        $user = new User;
        $user->role_id=$request->role;
        $user->name=$request->name;
        $user->username=$request->username;
        $user->email=$request->email;
        $user->mobile=$request->phone;
        $user->address=$request->address;
        $user->image=$imageName;
        $user->password=bcrypt($request->password);
        $user->save();
        Toastr::info('Success', 'Data store success');
        return back();

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete([

        ]);
        Toastr::warning('Success', 'Data delete success');
        return back();
    }
}
