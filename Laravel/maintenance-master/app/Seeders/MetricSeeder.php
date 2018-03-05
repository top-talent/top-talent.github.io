<?php

namespace App\Seeders;

use App\Repositories\MetricRepository;
use App\Services\ConfigService;
use Illuminate\Database\Seeder;

class MetricSeeder extends Seeder
{
    /**
     * @var MetricRepository
     */
    protected $metric;

    /**
     * @var ConfigService
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param MetricRepository $metric
     * @param ConfigService    $config
     */
    public function __construct(MetricRepository $metric, ConfigService $config)
    {
        $this->metric = $metric;
        $this->config = $config->setPrefix('maintenance');
    }

    /**
     * Runs the seeding operations.
     */
    public function run()
    {
        $metrics = $this->getSeedData();

        foreach ($metrics as $metric) {
            $this->metric->model()->create($metric);
        }
    }

    /**
     * Retrieves the seed data from the maintenance configuration.
     *
     * @return mixed
     */
    private function getSeedData()
    {
        return $this->config->get('seed.metrics');
    }
}
