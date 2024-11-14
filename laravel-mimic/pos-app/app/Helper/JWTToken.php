<?php

namespace App\Helper;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PhpParser\Node\Expr\Cast\Object_;

class JWTToken
{
    public static function CreateToken($userEmail, $userID):string
    {
        $key = env('JWT_KEY');
        $payload =[
          'iss' => "laravel-token",
          'iat' => time(),
          'exp' => time()+(60*60*24),
          'userEmail' => $userEmail,
          'userID' => $userID,
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    public static function VerifyToken($token):string|object
    {
        try{
            $key = env('JWT_KEY');
            if($token == null){
                return 'unauthorized';
            }
            else{
                return JWT::decode($token, new Key($key, 'HS256'));
            }
        }
        catch (\Exception $e){
            return 'unauthorized';
        }
    }

    public static function CreateTokenForSetPassword($userEmail):string
    {
        $key = env('JWT_KEY');
        $payload =[
            'iss' => "laravel-token",
            'iat' => time(),
            'exp' => time()+(60*60*6),
            'userEmail' => $userEmail,
            'userID' => '0',
        ];

        return JWT::encode($payload, $key, 'HS256');
    }


}
