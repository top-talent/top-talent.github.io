<?php

namespace App\Http\Controllers\WorkOrder;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttachmentRequest;
use App\Http\Requests\AttachmentUpdateRequest;
use App\Processors\WorkOrder\WorkOrderAttachmentProcessor;

class WorkOrderAttachmentController extends Controller
{
    /**
     * @var WorkOrderAttachmentProcessor
     */
    protected $processor;

    /**
     * Constructor.
     *
     * @param WorkOrderAttachmentProcessor $processor
     */
    public function __construct(WorkOrderAttachmentProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Displays a list of the work order attachments.
     *
     * @param int|string $workOrderId
     *
     * @return \Illuminate\View\View
     */
    public function index($workOrderId)
    {
        return $this->processor->index($workOrderId);
    }

    /**
     * Displays the form to create work order attachments.
     *
     * @param int|string $workOrderId
     *
     * @return \Illuminate\View\View
     */
    public function create($workOrderId)
    {
        return $this->processor->create($workOrderId);
    }

    /**
     * Processes storing the attachment record.
     *
     * @param AttachmentRequest $request
     * @param int|string        $workOrderId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AttachmentRequest $request, $workOrderId)
    {
        if ($uploaded = $this->processor->store($request, $workOrderId)) {
            $count = (is_array($uploaded) ? count($uploaded) : 0);

            flash()->success('Success!', "Successfully uploaded $count file(s).");

            return redirect()->route('maintenance.work-orders.attachments.index', [$workOrderId]);
        } else {
            flash()->error('Error!', 'There was an issue uploading the files you selected. Please try again.');

            return redirect()->route('maintenance.work-orders.attachments.create', [$workOrderId]);
        }
    }

    /**
     * Displays the uploaded file with it's information.
     *
     * @param int|string $workOrderId
     * @param int|string $attachmentId
     *
     * @return \Illuminate\View\View
     */
    public function show($workOrderId, $attachmentId)
    {
        return $this->processor->show($workOrderId, $attachmentId);
    }

    /**
     * Displays the form for editing an uploaded file.
     *
     * @param int|string $workOrderId
     * @param int|string $attachmentId
     *
     * @return \Illuminate\View\View
     */
    public function edit($workOrderId, $attachmentId)
    {
        return $this->processor->edit($workOrderId, $attachmentId);
    }

    /**
     * Updates the specified ticket upload.
     *
     * @param AttachmentUpdateRequest $request
     * @param int|string              $workOrderId
     * @param int|string              $attachmentId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AttachmentUpdateRequest $request, $workOrderId, $attachmentId)
    {
        if ($this->processor->update($request, $workOrderId, $attachmentId)) {
            flash()->success('Success!', 'Successfully updated attachment.');

            return redirect()->route('maintenance.work-orders.attachments.show', [$workOrderId, $attachmentId]);
        } else {
            flash()->error('Error!', 'There was an issue updating this attachment. Please try again.');

            return redirect()->route('maintenance.work-orders.attachments.edit', [$workOrderId, $attachmentId]);
        }
    }

    /**
     * Processes deleting an attachment record and the file itself.
     *
     * @param int|string $workOrderId
     * @param int|string $attachmentId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($workOrderId, $attachmentId)
    {
        if ($this->processor->destroy($workOrderId, $attachmentId)) {
            flash()->success('Success!', 'Successfully deleted attachment.');

            return redirect()->route('maintenance.work-orders.attachments.index', [$workOrderId]);
        } else {
            flash()->error('Error!', 'There was an issue deleting this attachment. Please try again.');

            return redirect()->route('maintenance.work-orders.attachments.show', [$workOrderId, $attachmentId]);
        }
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
        return $this->processor->download($workOrderId, $attachmentId);
    }
}
