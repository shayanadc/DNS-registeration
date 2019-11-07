<?php
/**
 * Created by PhpStorm.
 * User: shayanadc
 * Date: 11/4/19
 * Time: 5:00 PM
 */

namespace App;


class ApprovedDomainUseCase
{
    public $recordType;
    public $domainName;
    public function __construct(string $domainName, RecordType $recordType)
    {
        $this->domainName = $domainName;
        $this->recordType = $recordType;
    }

    public function process()
    {
        $lookUp = new DNSLookUp($this->recordType, $this->sendDigRequest());
        if($lookUp->isMatch()) {
            $this->recordType->domain->toApproved();
        }else{
            throw new \Exception('Dns Is Not Match To TXT Record Type');
        }

    }
    public function sendDigRequest(){
        $digRequest = new DigRequest($this->domainName);
        return $digRequest->resolveDomain();
    }
}