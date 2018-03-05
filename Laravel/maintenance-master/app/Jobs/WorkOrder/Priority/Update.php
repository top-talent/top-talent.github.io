<?php

namespace App\Jobs\WorkOrder\Priority;

use App\Http\Requests\WorkOrder\PriorityRequest;
use App\Jobs\Job;
use App\Models\Priority;

class Update extends Job
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
     * Executes the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->priority->name = $this->request->input('name', $this->priority->name);
        $this->priority->color = $this->request->input('color', $this->priority->color);

        return $this->priority->save();
    }
}
