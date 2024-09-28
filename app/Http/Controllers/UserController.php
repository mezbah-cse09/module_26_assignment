<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function LoginPage():View{
        return view('pages.auth.login-page');
    }

    function UserLogin(Request $request){
        $count = User::where('email',$request->input('email'))
                    ->where('password',$request->input('password'))
                    ->select('id','role')->first();

        // dd($count);
        if($count !== null){
            //issue Token
            $token = JWTToken::CreateToken($count->id,$count->role);

            $user = User::find($count->id);
            // dd($user);
            $isAdmin = $user->isAdmin();
            $isCustomer = $user->isCustomer();
            return response()->json([
                'status' => 'success',
                'message' => 'user Login Successful',
                'isAdmin' => $isAdmin,
                'isCustomer' => $isCustomer
            ])->cookie('token',$token,60); //after 60 min will expire
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' => 'User Unauthorized'
            ],status: 200);
        }
    }

    function UserLogOut(){
        return redirect('/login')->cookie('token','',-1);
    }

    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
