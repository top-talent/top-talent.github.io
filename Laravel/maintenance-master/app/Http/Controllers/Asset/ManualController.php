<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\Asset\ManualRequest;
use App\Http\Requests\AttachmentUpdateRequest;
use App\Repositories\Asset\ManualRepository;
use App\Repositories\Asset\Repository as AssetRepository;

class ManualController extends BaseController
{
    /**
     * @var AssetRepository
     */
    protected $asset;

    /**
     * Constructor.
     *
     * @param AssetRepository  $asset
     * @param ManualRepository $manual
     */
    public function __construct(AssetRepository $asset, ManualRepository $manual)
    {
        $this->asset = $asset;
        $this->manual = $manual;
    }

    /**
     * Displays all of the specified asset manuals.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $asset = $this->asset->find($id);

        return view('assets.manuals.index', compact('asset'));
    }

    /**
     * Displays the asset manual upload form.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        $asset = $this->asset->find($id);

        return view('assets.manuals.create', compact('asset'));
    }

    /**
     * Uploads manuals and attaches them to the specified asset.
     *
     * @param ManualRequest $request
     * @param int|string    $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ManualRequest $request, $id)
    {
        $asset = $this->asset->find($id);

        $attachments = $this->manual->upload($request, $asset, $asset->manuals());

        if ($attachments) {
            $message = 'Successfully uploaded files.';

            return redirect()->route('maintenance.assets.manuals.index', [$asset->id])->withSuccess($message);
        } else {
            $message = 'There was an issue uploading the files you selected. Please try again.';

            return redirect()->route('maintenance.assets.manuals.create', [$id])->withErrors($message);
        }
    }

    /**
     * Displays the asset manual.
     *
     * @param int|string $id
     * @param int|string $manualId
     *
     * @return \Illuminate\View\View
     */
    public function show($id, $manualId)
    {
        $asset = $this->asset->find($id);

        $manual = $asset->manuals()->find($manualId);

        if ($manual) {
            return view('assets.manuals.show', compact('asset', 'manual'));
        }

        abort(404);
    }

    /**
     * Displays the form for editing an uploaded manual.
     *
     * @param int|string $id
     * @param int|string $manualId
     *
     * @return \Illuminate\View\View
     */
    public function edit($id, $manualId)
    {
        $asset = $this->asset->find($id);

        $manual = $asset->manuals()->find($manualId);

        if ($manual) {
            return view('assets.manuals.edit', compact('asset', 'manual'));
        }

        abort(404);
    }

    /**
     * Updates the specified asset manual upload.
     *
     * @param AttachmentUpdateRequest $request
     * @param int|string              $id
     * @param int|string              $manualId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AttachmentUpdateRequest $request, $id, $manualId)
    {
        $asset = $this->asset->find($id);

        $manual = $this->manual->update($request, $asset->manuals(), $manualId);

        if ($manual) {
            $message = 'Successfully updated manual.';

            return redirect()->route('maintenance.assets.manuals.show', [$asset->id, $manual->id])->withSuccess($message);
        } else {
            $message = 'There was an issue updating this manual. Please try again.';

            return redirect()->route('maintenance.assets.manuals.show', [$id, $manualId])->withErrors($message);
        }
    }

    /**
     * Processes deleting an attachment record and the file itself.
     *
     * @param int|string $id
     * @param int|string $manualId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, $manualId)
    {
        $asset = $this->asset->find($id);

        $manual = $asset->manuals()->find($manualId);

        if ($manual && $manual->delete()) {
            $message = 'Successfully deleted manual.';

            return redirect()->route('maintenance.assets.manuals.index', [$asset->id])->withSuccess($message);
        } else {
            $message = 'There was an issue deleting this manual. Please try again.';

            return redirect()->route('maintenance.assets.manuals.show', [$asset->id, $manual->id])->withErrors($message);
        }
    }

    /**
     * Prompts the user to download the specified uploaded file.
     *
     * @param int|string $id
     * @param int|string $manualId
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id, $manualId)
    {
        $asset = $this->asset->find($id);

        $manual = $asset->manuals()->find($manualId);

        if ($manual) {
            return response()->download($manual->download_path);
        }

        abort(404);
    }
}
