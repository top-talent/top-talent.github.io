<?php

namespace App\Processors\Asset;

use App\Http\Presenters\Asset\AssetPresenter;
use App\Http\Requests\Asset\AssetRequest;
use App\Models\Asset;
use App\Processors\Processor;
use Illuminate\Contracts\Auth\Guard;

class AssetProcessor extends Processor
{
    /**
     * @var Asset
     */
    protected $asset;

    /**
     * @var Guard
     */
    protected $guard;

    /**
     * @var AssetPresenter
     */
    protected $presenter;

    /**
     * Constructor.
     *
     * @param Asset          $asset
     * @param Guard          $guard
     * @param AssetPresenter $presenter
     */
    public function __construct(Asset $asset, Guard $guard, AssetPresenter $presenter)
    {
        $this->asset = $asset;
        $this->guard = $guard;
        $this->presenter = $presenter;
    }

    /**
     * Displays all assets.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $navbar = $this->presenter->navbar();

        $assets = $this->presenter->table($this->asset);

        return view('assets.index', compact('assets', 'navbar'));
    }

    /**
     * Displays the form for creating assets.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $form = $this->presenter->form($this->asset);

        return view('assets.create', compact('form'));
    }

    /**
     * Creates a new asset.
     *
     * @param AssetRequest $request
     *
     * @return bool
     */
    public function store(AssetRequest $request)
    {
        $asset = $this->asset->newInstance();

        $asset->user_id = $this->guard->id();
        $asset->tag = $request->input('tag');
        $asset->category_id = $request->input('category');
        $asset->location_id = $request->input('location');
        $asset->name = $request->input('name');
        $asset->condition = $request->input('condition');
        $asset->vendor = $request->input('vendor');
        $asset->make = $request->input('make');
        $asset->model = $request->input('model');
        $asset->size = $request->input('size');
        $asset->weight = $request->input('weight');
        $asset->serial = $request->input('serial');
        $asset->acquired_at = $request->formatDateWithTime($request->input('acquired_at'));
        $asset->end_of_life = $request->formatDateWithTime($request->input('end_of_life'));

        return $asset->save();
    }

    /**
     * Displays the specified asset.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $asset = $this->asset->findOrFail($id);

        return view('assets.show', compact('asset'));
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
        $asset = $this->asset->findOrFail($id);

        $form = $this->presenter->form($asset);

        return view('assets.edit', compact('form'));
    }

    /**
     * Updates the specified asset.
     *
     * @param AssetRequest $request
     * @param int|string   $id
     *
     * @return bool
     */
    public function update(AssetRequest $request, $id)
    {
        $asset = $this->asset->findOrFail($id);

        $asset->tag = $request->input('tag');
        $asset->category_id = $request->input('category');
        $asset->location_id = $request->input('location');
        $asset->name = $request->input('name');
        $asset->condition = $request->input('condition');
        $asset->vendor = $request->input('vendor');
        $asset->make = $request->input('make');
        $asset->model = $request->input('model');
        $asset->size = $request->input('size');
        $asset->weight = $request->input('weight');
        $asset->serial = $request->input('serial');
        $asset->acquired_at = $request->formatDateWithTime($request->input('acquired_at'));
        $asset->end_of_life = $request->formatDateWithTime($request->input('end_of_life'));

        return $asset->save();
    }

    /**
     * Deletes the specified asset.
     *
     * @param int|string $id
     *
     * @return bool
     */
    public function destroy($id)
    {
        $asset = $this->asset->findOrFail($id);

        return $asset->delete();
    }
}
