<?php
/**
 * Created by PhpStorm.
 * User: shayanadc
 * Date: 11/4/19
 * Time: 12:02 PM
 */

namespace App;


class DigRequest
{
    public $domain;
    public function __construct($domain){
        $this->domain = $domain;
    }
    public function digRequest(){
        return 'foo';
    }
}