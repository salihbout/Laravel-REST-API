<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Mail\UserCreated;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\http\Resources\User as UserResource;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('client.credentials')->only(['store', 'resend']);
        $this->middleware('auth:api')->except(['index', 'show']);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(15);

        return UserResource::collection($user);
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


        //$user = $request->isMethod('put') ? User::findOrFail($request->user_id) : new User;
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
        
        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = bcrypt($request->passport);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGULAR_USER;

        $user = User::create($data);

        if($user->save()){
            return new UserResource($user);
        }


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
        return new UserResource($user);
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
        $user = User::findOrFail($id);

        $rules = [
            
            'email' => 'email|unique:users,email,'.$user->id,
            'password' => 'min:6|confirmed',
        ];
        
        $this->validate($request, $rules);

        
        if($request->has('name')){
            $user->name = $request->name;
        }

        if($request->has('email') && $user->email != $request->email){
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;

        }

        if($request->has('password')){
            $user->password = bcrypt($request->password);

        }

        if(!$user->isDirty()){
            return response()->json(['error' => 'you need to specify a different value to update', 'code' =>409], 409);

        }

        if($user->save()){
            return new UserResource($user);
        }else{
            return response()->json(['error' => 'Something went wrong ... !', 'code' =>409], 409);

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
        $user = User::findOrFail($id);
        if($user->delete()){
            return new UserResource($user);

        }
    }

    public function verify($token){
        $user = User::where('verification_token',$token)->firstOrFail();
        $user->verified = User::VERIFIED_USER;
        $user->verification_token = null;

        if($user->save()){
            return response()->json(['success' => 'Your account has been successfully verified !', 'code' =>409], 409);

        }

    }

    public function resend($id){

        $user = User::findOrFail($id);

        if($user->isVerified()){
            return response()->json(['error' => 'Your account is already verified. Thanks !', 'code' =>409], 409);

        }
        
        Mail::to($user)->send(new UserCreated($user));
        
        return response()->json(['success' => 'A verification link is resent again to your email !', 'code' =>409], 409);


    }
}
