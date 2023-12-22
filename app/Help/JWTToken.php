<?php
namespace App\Help;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

 class JWTToken{
    public static function MakeToken($userEmail,$userID){
         $key = env('SECRET_KEY');
         $payload=[
            'iss'=>'deloar',
            'iat'=>time(),
            'exp'=>time()+60*60,
            'userEmail'=>$userEmail,
            'userID'=>$userID
         ];

        return JWT::encode($payload,$key,'HS256');

    }
    public static function TestToken($token){
      try {
        $key=env('SECRET_KEY');
        $decoded=JWT::decode($token,new Key($key,'HS256'));
        return $decoded;
      } catch (Exception $e) {
        return "notValid";
      }
    }
 }