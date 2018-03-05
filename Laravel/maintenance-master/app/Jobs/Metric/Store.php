<?php

namespace App\Jobs\Metric;

use App\Http\Requests\MetricRequest;
use App\Jobs\Job;
use App\Models\Metric;

class Store extends Job
{
    /**
     * @var MetricRequest
     */
    protected $request;

    /**
     * @var Metric
     */
    protected $metric;

    /**
     * Constructor.
     *
     * @param MetricRequest $request
     * @param Metric        $metric
     */
    public function __construct(MetricRequest $request, Metric $metric)
    {
        $this->request = $request;
        $this->metric = $metric;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->metric->user_id = auth()->id();
        $this->metric->name = $this->request->input('name');
        $this->metric->symbol = $this->request->input('symbol');

        return $this->metric->save();
    }
}
