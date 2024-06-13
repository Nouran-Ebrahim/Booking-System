<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthanticationController extends Controller
{
    public function __construct()
    {
        # By default we are using here auth:api middleware
        $this->middleware('auth:client', ['except' => ['login', 'register']]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return return_msg(
                false,
                'Validation Errors',
                ['validation_errors' => $validator->getMessageBag()],
                'validation_error'
            );
        } else {
            $client = Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $data=['payload'=>$client];
            return return_msg(
                true,
                'Client Created Successfully',
                $data,
            );
        }


    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:clients,email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return return_msg(
                false,
                'Validation Errors',
                ['validation_errors' => $validator->getMessageBag()],
                'validation_error'
            );
        }
        $credentials = request(['email', 'password']);

        if (! $token = auth('client')->attempt($credentials)) {
            return return_msg(false,'Unauthorized',null,'unauthorized');
        }
        return $this->respondWithToken($token);


    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    public function logout()
    {
        auth('client')->logout();
        return return_msg(true, "Successfully logged out");
    }
    protected function respondWithToken($token)
    {
        $client = Client::query()->where('id',\auth('client')->id())->first();
        $data = ['access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('client')->factory()->getTTL() * 60,
            'payload' => $client,
        ];
        return return_msg(true,'Authenticated User',$data);
    }
}
