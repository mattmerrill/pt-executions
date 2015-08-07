<?php

namespace App\Jobs;


class DeferrableFeatureExecution extends Job
{
    /**
     * @var array|string
     */
    private $accountId;
    /**
     * @var
     */
    private $featureInstanceId;

    /**
     * DeferrableFeatureExecution constructor.
     * @param int $accountId
     * @param int $featureInstanceId
     */
    public function __construct($accountId, $featureInstanceId)
    {

        $this->accountId = $accountId;
        $this->featureInstanceId = $featureInstanceId;
    }

    public function handle()
    {

    }
}