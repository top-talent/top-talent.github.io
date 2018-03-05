<?php

namespace App\Processors\WorkOrder;

use App\Http\Presenters\WorkOrder\WorkOrderAttachmentPresenter;
use App\Http\Requests\AttachmentRequest;
use App\Http\Requests\AttachmentUpdateRequest;
use App\Jobs\Attachment\Destroy;
use App\Jobs\Attachment\Store;
use App\Jobs\Attachment\Update;
use App\Models\WorkOrder;
use App\Processors\Processor;

class WorkOrderAttachmentProcessor extends Processor
{
    /**
     * @var WorkOrder
     */
    protected $workOrder;

    /**
     * @var WorkOrderAttachmentPresenter
     */
    protected $presenter;

    /**
     * Constructor.
     *
     * @param WorkOrder                    $workOrder
     * @param WorkOrderAttachmentPresenter $presenter
     */
    public function __construct(WorkOrder $workOrder, WorkOrderAttachmentPresenter $presenter)
    {
        $this->workOrder = $workOrder;
        $this->presenter = $presenter;
    }

    /**
     * Displays all of the specified work orders attachments.
     *
     * @param int|string $workOrderId
     *
     * @return \Illuminate\View\View
     */
    public function index($workOrderId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $attachments = $this->presenter->table($workOrder);

        $navbar = $this->presenter->navbar($workOrder);

        return view('work-orders.attachments.index', compact('attachments', 'navbar'));
    }

    /**
     * Displays the form for adding attachments to the specified work order.
     *
     * @param int|string $workOrderId
     *
     * @return \Illuminate\View\View
     */
    public function create($workOrderId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $form = $this->presenter->form($workOrder, $workOrder->attachments()->getRelated());

        return view('work-orders.attachments.create', compact('form'));
    }

    /**
     * Processes uploading and adding attaachments to the specified work order.
     *
     * @param AttachmentRequest $request
     * @param int|string        $workOrderId
     *
     * @return bool|array
     */
    public function store(AttachmentRequest $request, $workOrderId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        return $this->dispatch(new Store($request, $workOrder->attachments()));
    }

    /**
     * Displays the work order attachments.
     *
     * @param int|string $workOrderId
     * @param int|string $attachmentId
     *
     * @return \Illuminate\View\View
     */
    public function show($workOrderId, $attachmentId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $attachment = $workOrder->attachments()->findOrFail($attachmentId);

        return view('work-orders.attachments.show', compact('workOrder', 'attachment'));
    }

    /**
     * Displays the form for editing the specified work order attachment.
     *
     * @param int|string $workOrderId
     * @param int|string $attachmentId
     *
     * @return \Illuminate\View\View
     */
    public function edit($workOrderId, $attachmentId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $attachment = $workOrder->attachments()->findOrFail($attachmentId);

        $form = $this->presenter->form($workOrder, $attachment);

        return view('work-orders.attachments.edit', compact('form'));
    }

    /**
     * Updates the specified work order attachment.
     *
     * @param AttachmentUpdateRequest $request
     * @param int|string              $workOrderId
     * @param int|string              $attachmentId
     *
     * @return bool
     */
    public function update(AttachmentUpdateRequest $request, $workOrderId, $attachmentId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $attachment = $workOrder->attachments()->findOrFail($attachmentId);

        return $this->dispatch(new Update($request, $attachment));
    }

    /**
     * Deletes the specified work order attachment.
     *
     * @param int|string $workOrderId
     * @param int|string $attachmentId
     *
     * @return bool
     */
    public function destroy($workOrderId, $attachmentId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $attachment = $workOrder->attachments()->findOrFail($attachmentId);

        return $this->dispatch(new Destroy($attachment));
    }

    /**
     * Prompts the user to download the specified uploaded file.
     *
     * @param int|string $workOrderId
     * @param int|string $attachmentId
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($workOrderId, $attachmentId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $attachment = $workOrder->attachments()->findOrFail($attachmentId);

        return response()->download($attachment->download_path);
    }
}
