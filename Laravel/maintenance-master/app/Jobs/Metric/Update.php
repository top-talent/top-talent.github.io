<?php

namespace App\Jobs\Metric;

use App\Http\Requests\MetricRequest;
use App\Jobs\Job;
use App\Models\Metric;

class Update extends Job
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
        $this->metric->name = $this->request->input('name', $this->metric->name);
        $this->metric->symbol = $this->request->input('symbol', $this->metric->symbol);

        return $this->metric->save();
    }
}
