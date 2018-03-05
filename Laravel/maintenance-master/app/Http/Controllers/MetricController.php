<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetricRequest;
use App\Processors\MetricProcessor;

class MetricController extends Controller
{
    /**
     * @var MetricProcessor
     */
    protected $processor;

    /**
     * Constructor.
     *
     * @param MetricProcessor $processor
     */
    public function __construct(MetricProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Displays all metrics.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return $this->processor->index();
    }

    /**
     * Displays the form to create a metric.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return $this->processor->create();
    }

    /**
     * Creates a metric.
     *
     * @param MetricRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MetricRequest $request)
    {
        if ($this->processor->store($request)) {
            flash()->success('Success!', 'Successfully created metric.');

            return redirect()->route('maintenance.metrics.index');
        } else {
            flash()->error('Error!', 'There was an issue creating this metric. Please try again.');

            return redirect()->route('maintenance.metrics.index');
        }
    }

    /**
     * Displays information about the metric.
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
     * Displays the form for editing the specified metric.
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
     * Updates the specified metric.
     *
     * @param MetricRequest $request
     * @param int|string    $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MetricRequest $request, $id)
    {
        if ($this->processor->update($request, $id)) {
            flash()->success('Success!', 'Successfully updated metric.');

            return redirect()->route('maintenance.metrics.index');
        } else {
            flash()->error('Error!', 'There was an issue updating this metric. Please try again.');

            return redirect()->route('maintenance.metrics.edit', [$id]);
        }
    }

    /**
     * Updates the specified metric.
     *
     * @param int|string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if ($this->processor->destroy($id)) {
            flash()->success('Success!', 'Successfully deleted metric.');

            return redirect()->route('maintenance.metrics.index');
        } else {
            flash()->error('Error!', 'There was an issue deleting this metric. Please try again.');

            return redirect()->route('maintenance.metrics.edit', [$id]);
        }
    }
}
