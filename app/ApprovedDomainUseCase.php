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
    public function process()
    {
        $waitingDomainList = Domain::waiting()->get();
//        foreach ($waitingDomainList as $domain){
            $waitingDomainList->map(function($domain) {
            $digRequest = new DigRequest($domain->name);
            $digAnswer = $digRequest->resolveDomain();
            $lookUp = new DNSLookUp($domain->records,$digAnswer);
            if($lookUp->isMatch()){
                $domain->toApproved();
            }
            });
    }
}