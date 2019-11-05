<?php

namespace App\Jobs;

use App\ApprovedDomainUseCase;
use App\DigRequest;
use App\DNSLookUp;
use App\Domain;
use App\RecordType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DomainResolverJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 2;
    /**
     * The number of seconds to wait before retrying the job.
     * After 2 hours
     * @var int
     */
//    public $retryAfter = 7200;
    public $retryAfter = 7;

    public $domain;
    public $recordType;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $domain, RecordType $recordType)
    {
       $this->domain = $domain;
       $this->recordType = $recordType;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
     $domainResolver = new ApprovedDomainUseCase($this->domain, $this->recordType);
     try{
         $domainResolver->process();
         $this->delete();
     }catch (\Exception $exception){
         throw new \Exception('DONT Do This JOB' . $this->recordType->id);
     }
    }
    public function retryUntil()
    {
        return now()->addDay(2);
    }
    public function failed()
    {
        Log::info('FAILED JOB' . $this->domain);
    }
}
