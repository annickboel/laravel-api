<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class UserController extends Controller
{
    /**
     * Display a listing of User resources.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index()
    {
    	try {
	        $users = User::all();
	        return response($users, 200);
    	}
    	catch (Exception $e) {
    		return response()->json(['error'=>'Internal Server Error'], 500);
    	}
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      	try {
      		$result = $request->validate([
                'login' => 'required',
                'password' => 'required',
                'email' => 'required',
                'name' => 'required',
                'firstname' => 'required',
                'age' => 'required'
            ]);
            if (isset($result->errors)) {
                return response()->json($result, 400);
            }
            $user = new User();
            $user->username = $request['login'];
            $user->password = $request['password'];
            $user->email = $request['email'];
           	$user->firstname = $request['firstname'];
            $user->name = $request['name']; 
            $user->age = $request['age'];
            $user->save();
            return response()->json(['message'=>'User successfully created'], 200);
    	}
    	catch (Exception $e) {
    		return response()->json(['error'=>'Internal Server Error'], 500);
    	}
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
      	try {
      		$result = $request->validate([
                'login' => 'required',
                'password' => 'required'
            ]);
            if (isset($result->errors)) {
                return response()->json($result, 400);
            }
            $user = User::where('username', $request['login'])->where('password', $request['password'])->first();
        	if ($user == null) {
        		return response()->json(['error'=>'Bad request'], 400);
        	}
            return response()->json(['message'=>'User successfully authenticated'], 200);

    	}
    	catch (Exception $e) {
    		return response()->json(['error'=>'Internal Server Error'], 500);
    	}
    }
}
