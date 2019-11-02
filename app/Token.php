<?php
/**
 * Created by PhpStorm.
 * User: shayanadc
 * Date: 11/2/19
 * Time: 3:09 PM
 */

namespace App;


use Illuminate\Support\Str;

class Token
{
    static $testToken = null;
    public static function generate(){
        return static::$testToken ?:Str::random(60);
    }

    public static function setTest($string){
        static::$testToken = $string;
    }

}