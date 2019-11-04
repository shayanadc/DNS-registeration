<?php
/**
 * Created by PhpStorm.
 * User: shayanadc
 * Date: 11/4/19
 * Time: 2:19 PM
 */

namespace App;


class DomainDigTransformer
{
    public $domainWithRecords;
    public function __construct($domainWithRecords)
    {
        $this->domainWithRecords = $domainWithRecords;
    }

    public function process(){
        $dig = new DigRequest('exampleA.com');
        dd($dig->digRequest());
    }
}