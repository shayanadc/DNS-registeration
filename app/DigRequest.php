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
    public $type;
    public function __construct($domain, $type = DNS_TXT){
        $this->domain = $domain;
        $this->type = $type;
    }
    public function resolveDomain(){
        return dns_get_record($this->domain, DNS_TXT);
    }
}