<?php

namespace App\Processors;

use App\Http\Presenters\MetricPresenter;
use App\Http\Requests\MetricRequest;
use App\Jobs\Metric\Store;
use App\Jobs\Metric\Update;
use App\Models\Metric;

class MetricProcessor extends Processor
{
    /**
     * @var Metric
     */
    protected $metric;

    /**
     * @var MetricPresenter
     */
    protected $presenter;

    /**
     * Constructor.
     *
     * @param Metric          $metric
     * @param MetricPresenter $presenter
     */
    public function __construct(Metric $metric, MetricPresenter $presenter)
    {
        $this->metric = $metric;
        $this->presenter = $presenter;
    }

    /**
     * Displays all metrics.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $metrics = $this->presenter->table($this->metric);

        $navbar = $this->presenter->navbar();

        return view('metrics.index', compact('metrics', 'navbar'));
    }

    /**
     * Displays the form for creating a new metric.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $form = $this->presenter->form($this->metric);

        return view('metrics.create', compact('form'));
    }

    /**
     * Creates a new metric.
     *
     * @param MetricRequest $request
     *
     * @return mixed
     */
    public function store(MetricRequest $request)
    {
        $metric = $this->metric->newInstance();

        return $this->dispatch(new Store($request, $metric));
    }

    /**
     * Displays the specified metric.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $metric = $this->metric->findOrFail($id);

        return view('metrics.show', compact('metric'));
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
        $metric = $this->metric->findOrFail($id);

        $form = $this->presenter->form($metric);

        return view('metrics.edit', compact('form'));
    }

    public function update(MetricRequest $request, $id)
    {
        $metric = $this->metric->findOrFail($id);

        return $this->dispatch(new Update($request, $metric));
    }

    /**
     * Deletes the specified metric.
     *
     * @param int|string $id
     *
     * @return bool
     */
    public function destroy($id)
    {
        $metric = $this->metric->findOrFail($id);

        return $metric->delete();
    }
}
