<?php
/**
 * Created by PhpStorm.
 * User: shayanadc
 * Date: 11/4/19
 * Time: 5:00 PM
 */

namespace App;


use App\Jobs\DomainResolverJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
        $lookUp = new DNSLookUp($this->recordType,$digAnswer);
        if($lookUp->isMatch()) {
            $this->recordType->domain->toApproved();
        }else{
            throw new \Exception('aga');
        }

    }
}