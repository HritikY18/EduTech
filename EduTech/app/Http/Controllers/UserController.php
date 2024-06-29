<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $user = User::findOrFail($id);
        return view('user.profile',['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, $id)
    {   
        if (request()->hasFile('profile')) {
            $profileImage = request()->file('profile');
            $profileImageName = $profileImage->getClientOriginalName();
            $path = $profileImage->store('public/profile_images');
            $profileImageName = basename($path);


            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->profile = $profileImageName;
            $user->phone = $request->input('phone');
            $user->dob = $request->input('dob');
            $user->address = $request->input('address');
            $user->save();
        }
        else{
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->phone = $request->input('phone');
            $user->dob = $request->input('dob');
            $user->address = $request->input('address');
            $user->save();
        }
        return redirect(route("$user->role.index"))->with('success',"Profile Upadated Successfully!");
    }

    public function changePassword()
    {
        return view('user.changePassword');
    }
    public function changePasswordStore(ChangePasswordRequest $request)
    {
        $user = auth()->user();
        if (Hash::check($request->currentPassword, $user->password))  {
                    $user->password = Hash::make($request->input('password'));
                    $user->save();
                    return redirect(route("$user->role.index"))->with('success','Password Changed Successfully!');
            }
            else{
                // session()->flash('password-not-matched','Password not matched!');
                return redirect(route('user.changePassword',$user))->with('password-not-matched','Password not matched!');
            }
            
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
