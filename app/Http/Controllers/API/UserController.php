<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin');
        return User::latest()->paginate(20);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
           'name'=>'required|string',
           'email'=>'required|string|unique:users',
           'bioData'=>'string|max:191',
           'password'=>'required|string|min:6',
       ]);


         $data = [ 
             'name'      => $request->name,
             'email'     => $request->email,
             'type'      => $request->type,
             'bioData'      => $request->bioData,
             'password'  => Hash::make($request->password)
         ];                         
         return User::create($data);
         
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
     * 
     * profile function 
     **/
    public function profile()
    {
        return auth('api')->user();
    }

    /**
     * 
     * profile update without
    **/
    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();
        $this->validate($request, [
            'name'      =>'required|string',
            'email'     =>'required|string|unique:users,email,'.$user->id,
            'bioData'   =>'string|max:191',
            'password'  =>'sometimes|required|min:6',
        ]);
        
        $storedImage =  $user->photo;
        if($request->photo != $storedImage ){
            $name = time().'.'.explode('/', explode(':',\substr($request->photo, 0, \strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('images/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('/images/profile/').$storedImage;

            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }

        }


        
        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request->password)]);

        }

        $user->update($request->all());
        return ['message'=>"Success"];
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
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name'      =>'required|string',
            'email'     =>'required|string|unique:users,email,'.$user->id,
            'bioData'   =>'string||max:191',
            'password'  =>'sometimes|required|min:6',
        ]);
        $data = [ 
            'name'      => $request->name,
            'email'     => $request->email,
            'type'      => $request->type,
            'bioData'   => $request->bioData,
            'password'  => $request->type
        ]; 
   
        $user->update($data);
        return ['message'=>'User updated successfully'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        $user->delete();
        return ['message'=> 'User Deleted Successfully'];
    }
}
