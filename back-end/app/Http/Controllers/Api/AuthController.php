<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController as ResponseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Validator;

class AuthController extends ResponseController
{
    /**
     * Api registro
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        return DB::transaction(function() use ($request){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|',
                'email' => 'required|string|email|unique:users',
                'password' => 'required',
                'confirm_password' => 'required|same:password'
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            if($user){
                $success['token'] =  $user->createToken('token')->accessToken;
                $success['name'] =  $user->name;

                return $this->sendResponse($success, 'User register successfully.');
            }
            else{
                $error = "Sorry! Registration is not successfull.";
                return $this->sendError('usuario nao criado', $error, 401);
            }
        });
    }

    //login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validador', $validator->errors());
        }

        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)){
            $error = "Unauthorized";
            return $this->sendError('Unauthorized', $error, 401);
        }
        $user = $request->user();
        $success['token'] =  $user->createToken('token')->accessToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User login successfully.');
    }

    //logout
    public function logout(Request $request)
    {
        $isUser = $request->user()->token()->revoke();
        if($isUser){
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse('Logout', $success['message']);
        }
        else{
            $error = "Something went wrong.";
            return $this->sendResponse('Logout', $error);
        }
    }

    //getuser
    public function getUser(Request $request)
    {
        //$id = $request->user()->id;
        $user = $request->user();
        if($user){
            return $this->sendResponse($user);
        }
        else{
            $error = "user not found";
            return $this->sendResponse($error);
        }
    }
}
