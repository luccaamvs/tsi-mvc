<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;

class APIController extends Controller
{
    public $loginAfterSignUp = true;

    public function login(Request $request){
        $token = null;
        $campos_json = json_decode($request->getContent(), JSON_OBJECT_AS_ARRAY);
        $credenciais = [    'email'     => $campos_json['email'],
                            'password'  => $campos_json['password']
                        ];
        try{
            //Se credenciais invalidas, retornarĂ¡ 401
            if(!$token = JWTAuth::attempt($credenciais)){

                return response()->json([   'success'   => false,
                                            'message'   => 'Credenciais Invalidas'], 401 );
            }
        }catch(JWTException $e){
            return response()->json([   'error' => 'Token n pode ser criado'], 500);
        }
        return response()->json([   'success'   => true,
                                    'token'     => $token], 200);
    }

    public function logout(Request $request){
        try{
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([   'success'  => true,
                                        'message'   => 'Token Invalidado']);
        }catch(JWTException $e){
            return response()->json([   'success'   => false,
                                        'message'   => 'Erro ao invalidar o token',
                                        'error'     => var_export($e->getMessage())], 500);
        }
    }
}
