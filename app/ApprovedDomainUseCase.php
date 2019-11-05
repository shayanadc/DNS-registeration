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
        $digRequest = new DigRequest($this->domainName);
        $digAnswer = $digRequest->resolveDomain();
        $lookUp = new DNSLookUp($this->recordType, $digAnswer);
        if($lookUp->isMatch()) {
            $this->recordType->domain->toApproved();
        }else{
            throw new \Exception('Dns Is Not Match To TXT Record Type');
        }

    }
}