<?php

namespace App\Jobs\Inventory;

use App\Http\Requests\Inventory\InventoryRequest;
use App\Jobs\Job;
use App\Models\Inventory;

class Update extends Job
{
    /**
     * @var InventoryRequest
     */
    protected $request;

    /**
     * @var Inventory
     */
    protected $inventory;

    /**
     * Constructor.
     *
     * @param InventoryRequest $request
     * @param Inventory        $inventory
     */
    public function __construct(InventoryRequest $request, Inventory $inventory)
    {
        $this->request = $request;
        $this->inventory = $inventory;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->inventory->category_id = $this->request->input('category', $this->inventory->category_id);
        $this->inventory->metric_id = $this->request->input('metric', $this->inventory->metric_id);
        $this->inventory->name = $this->request->input('name', $this->inventory->name);
        $this->inventory->description = $this->request->clean($this->request->input('description', $this->inventory->description));

        return $this->inventory->save();
    }
}
