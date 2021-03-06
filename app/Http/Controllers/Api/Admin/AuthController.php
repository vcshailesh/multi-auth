<?php
/**
 * Created by PhpStorm.
 * User: Shailesh Jakhaniya
 * Date: 25-09-2018
 * Time: 10:42
 */

namespace App\Http\Controllers\Api\Admin;


use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends AccessTokenController
{

    public function login(ServerRequestInterface $request)
    {
        try {

            $httpRequest = request();
            if ($httpRequest->grant_type == 'password') {
                $admin = Admin::where('email', $httpRequest->email)
                    ->first();

                return $this->issueToken($request);
            }
        }catch (\Exception $ex){
            Log::error($ex->getMessage());
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