<?php

class Token
{

    public static function generate()
    {
        return Sessions::put(Config::get('sessions/token_name'), md5(uniqid()));
    }

    public static function check($token)
    {
        $tokenName = Config::get('sessions/token_name');

        if (Sessions::exists($tokenName) && $token === Sessions::get($tokenName)) {
            Sessions::delete($tokenName);
            return true;
        }

        return false;
    }

}
