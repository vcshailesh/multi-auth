<?php
/**
 * Created by PhpStorm.
 * User: Shailesh Jakhaniya
 * Date: 25-09-2018
 * Time: 10:42
 */

namespace App\Http\Controllers\Api\Admin;


use App\Admin;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    public function login(){


        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }

    }

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|string|email|unique:admins',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $admin = new Admin([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $admin->save();

        return response()->json([
            'message' => 'Successfully created Admin!'
        ], 201);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function userInformation(Request $request)
    {
        return response()->json($request->user());
    }
}