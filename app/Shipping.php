<?php
/**
 * Created by PhpStorm.
 * User: shayanadc
 * Date: 11/7/19
 * Time: 11:05 AM
 */

namespace App;


class Shipping
{
    public function one(){
        return $this->two();
    }
    public function two(){
        return false;
    }
}