<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;

abstract class NestedSetController extends Controller
{
    /**
     * The resource name.
     *
     * @var string
     */
    public $resource = 'Category';

    /**
     * The nested set routes.
     *
     * @var array
     */
    public $routes = [];

    /**
     * The repository to create categories through.
     *
     * @var mixed
     */
    protected $repository;

    /**
     * Displays a list of all categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('categories.index', [
            'routes'   => $this->routes,
            'resource' => $this->resource,
        ]);
    }

    /**
     * Shows the form for creating a new category
     * or category node if an ID is supplied.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function create($id = null)
    {
        // If an ID is supplied then we're creating a child category
        if ($id) {
            $category = $this->repository->find($id);

            if ($category) {
                return view('categories.nodes.create', [
                    'category' => $category,
                    'resource' => $this->resource,
                    'routes'   => $this->routes,
                ]);
            }
        }

        return view('categories.create', [
            'resource' => $this->resource,
            'routes'   => $this->routes,
        ]);
    }

    /**
     * Processes storing a new category or storing a new category
     * underneath another if an ID is specified.
     *
     * @param CategoryRequest $request
     * @param int|string      $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request, $id = null)
    {
        $category = $this->repository->create($request, $id);

        if ($category) {
            $message = "Successfully created $this->resource";

            return redirect()->route($this->routes['index'])->withSuccess($message);
        } else {
            $message = "There was an issue creating a $this->resource. Please try again.";

            return redirect()->route($this->routes['create'], $id)->withErrors($message);
        }
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $category = $this->repository->find($id);

        return view('categories.edit', [
            'category' => $category,
            'resource' => $this->resource,
            'routes'   => $this->routes,
        ]);
    }

    /**
     * Processes updating the specified category.
     *
     * @param CategoryRequest $request
     * @param int|string      $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = $this->repository->update($request, $id);

        if ($category) {
            $message = "Successfully updated $this->resource";

            return redirect()->route($this->routes['index'])->withSuccess($message);
        } else {
            $message = "There was an issue updating this $this->resource. Please try again.";

            return redirect()->route($this->routes['edit'], $id)->withErrors($message);
        }
    }

    /**
     * Processes removing the specified category.
     *
     * @param int|string $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $record = $this->repository->find($id);

        if ($record->delete()) {
            $message = "Successfully deleted $this->resource.";

            return redirect()->route($this->routes['index'])->withSuccess($message);
        } else {
            $message = "There was an issue deleting this $this->resource. Please try again.";

            return redirect()->route($this->routes['index'])->withErrors($message);
        }
    }
}
