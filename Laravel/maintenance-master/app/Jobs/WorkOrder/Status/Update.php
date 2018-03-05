<?php

namespace App\Jobs\WorkOrder\Status;

use App\Http\Requests\WorkOrder\StatusRequest;
use App\Jobs\Job;
use App\Models\Status;

class Update extends Job
{
    /**
     * @var StatusRequest
     */
    protected $request;

    /**
     * @var Status
     */
    protected $status;

    /**
     * Constructor.
     *
     * @param StatusRequest $request
     * @param Status        $status
     */
    public function __construct(StatusRequest $request, Status $status)
    {
        $this->request = $request;
        $this->status = $status;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->status->name = $this->request->input('name', $this->status->name);
        $this->status->color = $this->request->input('color', $this->status->color);

        return $this->status->save();
    }
}
