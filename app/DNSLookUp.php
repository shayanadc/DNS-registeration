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
    public $record;
    public $dnsRecords;
    public function __construct($recordType, $dnsRecords)
    {
        $this->record = $recordType;
        $this->dnsRecords = $dnsRecords;
    }

    public function isMatch(){
        $verify = false;
        foreach ($this->dnsRecords as $dnsItem) {
                if($this->record['content'] == $dnsItem['txt']) $verify = true;
        }
        return $verify;
    }

}