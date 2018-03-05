<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\Asset\AssetRequest;
use App\Processors\Asset\AssetProcessor;

class Controller extends BaseController
{
    /**
     * @var AssetProcessor
     */
    protected $processor;

    /**
     * Constructor.
     *
     * @param AssetProcessor $processor
     */
    public function __construct(AssetProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Show the index of all assets.
     *
     * @return mixed
     */
    public function index()
    {
        return $this->processor->index();
    }

    /**
     * Show the create form for assets.
     *
     * @return mixed
     */
    public function create()
    {
        return $this->processor->create();
    }

    /**
     * Process and store the creation of the asset.
     *
     * @param AssetRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AssetRequest $request)
    {
        if ($this->processor->store($request)) {
            flash()->success('Success!', 'Successfully created asset.');

            redirect()->route('maintenance.assets.index');
        } else {
            flash()->error('Error!', 'There was an issue creating an asset. Please try again.');

            redirect()->route('maintenance.assets.create');
        }
    }

    /**
     * Displays the asset.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return $this->processor->show($id);
    }

    /**
     * Displays the form for editing the specified asset.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return $this->processor->edit($id);
    }

    /**
     * Updates the specified asset.
     *
     * @param AssetRequest $request
     * @param int|string   $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AssetRequest $request, $id)
    {
        if ($this->processor->update($request, $id)) {
            flash()->success('Success!', 'Successfully updated asset.');

            return redirect()->route('maintenance.assets.show', [$id]);
        } else {
            flash()->error('Error!', 'There was an issue updating this asset. Please try again.');

            return redirect()->route('maintenance.assets.show', [$id]);
        }
    }

    /**
     * Deletes the specified asset.
     *
     * @param int|string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if ($this->processor->destroy($id)) {
            flash()->success('Success!', 'Successfully deleted asset.');

            return redirect()->route('maintenance.assets.index');
        } else {
            flash()->error('Error!', 'There was an issue deleting this asset. Please try again.');

            return redirect()->route('maintenance.assets.show', [$id]);
        }
    }
}
