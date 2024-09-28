<?php
namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken{


    public static function CreateToken($userId,$role):string{
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'car_rental-token',
            'iat' => time(),
            'exp' => time()+60*60, //after 60 min will expire
            'userId' => $userId,
            'role' => $role
        ];

        return JWT::encode($payload,$key,'HS256');
    }


    public static function VerifyToken($token){

        try{
            if($token==null){
                return 'unauthorized';
            }
            else{
                $key = env('JWT_KEY');
                $decode = JWT::decode(jwt: $token, keyOrKeyArray: new Key(keyMaterial: $key,algorithm: 'HS256'));
                return $decode;
            }
        }
        catch(Exception $e){
            // dd($e);
            return 'unauthorized';
        }
    }
}
