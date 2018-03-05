<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\Asset\ImageRequest;
use App\Http\Requests\AttachmentUpdateRequest;
use App\Repositories\Asset\ImageRepository;
use App\Repositories\Asset\Repository as AssetRepository;

class ImageController extends BaseController
{
    /**
     * @var AssetRepository
     */
    protected $asset;

    /**
     * @var ImageRepository
     */
    protected $image;

    /**
     * Constructor.
     *
     * @param AssetRepository $asset
     * @param ImageRepository $image
     */
    public function __construct(AssetRepository $asset, ImageRepository $image)
    {
        $this->asset = $asset;
        $this->image = $image;
    }

    /**
     * Displays all images attached to the specified asset.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $asset = $this->asset->find($id);

        return view('assets.images.index', compact('asset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int|string $assetId
     *
     * @return \Illuminate\View\View
     */
    public function create($assetId)
    {
        $asset = $this->asset->find($assetId);

        return view('assets.images.create', compact('asset'));
    }

    /**
     * Uploads images and attaches them to the specified asset.
     *
     * @param ImageRequest $request
     * @param int|string   $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ImageRequest $request, $id)
    {
        $asset = $this->asset->find($id);

        $attachments = $this->image->upload($request, $asset, $asset->images());

        if ($attachments) {
            $message = 'Successfully uploaded files.';

            return redirect()->route('maintenance.assets.images.index', [$asset->id])->withSuccess($message);
        } else {
            $message = 'There was an issue uploading the files you selected. Please try again.';

            return redirect()->route('maintenance.assets.images.create', [$id])->withErrors($message);
        }
    }

    /**
     * Displays the asset image.
     *
     * @param int|string $id
     * @param int|string $imageId
     *
     * @return \Illuminate\View\View
     */
    public function show($id, $imageId)
    {
        $asset = $this->asset->find($id);

        $image = $asset->images()->find($imageId);

        if ($image) {
            return view('assets.images.show', compact('asset', 'image'));
        }

        abort(404);
    }

    /**
     * Displays the form for editing an uploaded image.
     *
     * @param int|string $id
     * @param int|string $imageId
     *
     * @return \Illuminate\View\View
     */
    public function edit($id, $imageId)
    {
        $asset = $this->asset->find($id);

        $image = $asset->images()->find($imageId);

        if ($image) {
            return view('assets.images.edit', compact('asset', 'image'));
        }

        abort(404);
    }

    /**
     * Updates the specified asset image upload.
     *
     * @param AttachmentUpdateRequest $request
     * @param int|string              $id
     * @param int|string              $imageId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AttachmentUpdateRequest $request, $id, $imageId)
    {
        $asset = $this->asset->find($id);

        $image = $this->image->update($request, $asset->images(), $imageId);

        if ($image) {
            $message = 'Successfully updated image.';

            return redirect()->route('maintenance.assets.images.show', [$asset->id, $image->id])->withSuccess($message);
        } else {
            $message = 'There was an issue updating this image. Please try again.';

            return redirect()->route('maintenance.assets.images.show', [$id, $imageId])->withErrors($message);
        }
    }

    /**
     * Processes deleting an attachment record and the file itself.
     *
     * @param int|string $id
     * @param int|string $imageId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, $imageId)
    {
        $asset = $this->asset->find($id);

        $image = $asset->images()->find($imageId);

        if ($image && $image->delete()) {
            $message = 'Successfully deleted attachment.';

            return redirect()->route('maintenance.assets.images.index', [$asset->id])->withSuccess($message);
        } else {
            $message = 'There was an issue deleting this attachment. Please try again.';

            return redirect()->route('maintenance.assets.images.show', [$asset->id, $image->id])->withErrors($message);
        }
    }

    /**
     * Prompts the user to download the specified uploaded file.
     *
     * @param int|string $id
     * @param int|string $imageId
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id, $imageId)
    {
        $asset = $this->asset->find($id);

        $image = $asset->images()->find($imageId);

        if ($image) {
            return response()->download($image->download_path);
        }

        abort(404);
    }
}
