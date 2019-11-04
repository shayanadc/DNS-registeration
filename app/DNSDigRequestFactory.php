<?php
/**
 * Created by PhpStorm.
 * User: shayanadc
 * Date: 11/4/19
 * Time: 12:25 PM
 */

namespace App;


class DNSDigRequestFactory
{

    public $recordArray = [];
    public $dns = [];
    public function __construct($dns, $recordTypes)
    {

        $this->recordArray = $recordTypes;
        $this->dns = $dns;
    }
    public function process(){
        $dsn_lookup = new DNSLookUp($this->recordArray,$this->dns);
        return $dsn_lookup->verify();
    }

}