<?php
/**
 * Created by PhpStorm.
 * User: shayanadc
 * Date: 11/4/19
 * Time: 11:32 AM
 */

namespace App;


class DNSLookUp
{
    public $recordArray;
    public $dnsRecord;
    public function __construct($recordTypes, $dnsRecords)
    {
        $this->recordArray = $recordTypes;
        $this->dnsRecord = $dnsRecords;
    }

    public function verify(){
        $verify = false;
        foreach ($this->recordArray as $recordItem) {
            foreach ($this->dnsRecord as $dnsItem){
                if($recordItem['content'] == $dnsItem['txt']) $verify = true;
            }
        }
        return $verify;
    }

}