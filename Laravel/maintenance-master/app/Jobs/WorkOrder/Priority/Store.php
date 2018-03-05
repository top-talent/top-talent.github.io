<?php

namespace App\Jobs\WorkOrder\Priority;

use App\Http\Requests\WorkOrder\PriorityRequest;
use App\Jobs\Job;
use App\Models\Priority;

class Store extends Job
{
    /**
     * @var PriorityRequest
     */
    protected $request;

    /**
     * @var Priority
     */
    protected $priority;

    /**
     * Constructor.
     *
     * @param PriorityRequest $request
     * @param Priority        $priority
     */
    public function __construct(PriorityRequest $request, Priority $priority)
    {
        $this->request = $request;
        $this->priority = $priority;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->priority->user_id = auth()->id();
        $this->priority->name = $this->request->input('name');
        $this->priority->color = $this->request->input('color');

        return $this->priority->save();
    }
}
