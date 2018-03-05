<?php

namespace App\Http\Controllers\Asset\Meter;

use App\Http\Controllers\Controller as BaseController;
use App\Services\Asset\AssetService;
use App\Services\ConfigService;
use App\Services\Meter\MeterService;
use App\Services\Meter\ReadingService;
use App\Validators\Meter\ReadingValidator;

class ReadingController extends BaseController
{
    /**
     * @var AssetService
     */
    protected $asset;

    /**
     * @var MeterService
     */
    protected $meter;

    /**
     * @var ReadingService
     */
    protected $meterReading;

    /**
     * @var ConfigService
     */
    protected $config;

    /**
     * @var ReadingValidator
     */
    protected $meterReadingValidator;

    /**
     * @param AssetService     $asset
     * @param MeterService     $meter
     * @param ReadingService   $meterReading
     * @param ConfigService    $config
     * @param ReadingValidator $meterReadingValidator
     */
    public function __construct(
            AssetService $asset,
            MeterService $meter,
            ReadingService $meterReading,
            ConfigService $config,
            ReadingValidator $meterReadingValidator
    ) {
        $this->asset = $asset;
        $this->meter = $meter;
        $this->meterReading = $meterReading;
        $this->meterReadingValidator = $meterReadingValidator;

        $this->config = $config->setPrefix('maintenance');
    }

    public function store($asset_id, $meter_id)
    {
        if ($this->meterReadingValidator->passes()) {
            $asset = $this->asset->find($asset_id);
            $meter = $this->meter->find($meter_id);

            $data = $this->inputAll();
            $data['meter_id'] = $meter->id;

            /*
             * Check if duplicate reading entries are enabled
             */
            if ($this->config->get('rules.meters.prevent_duplicate_entries')) {
                /*
                 * If the last reading is the same as the reading being inputted
                 */
                if ($this->input('reading') === $meter->last_reading) {
                    /*
                     * Return warning message
                     */
                    $this->message = 'Please enter a reading different from the last reading';
                    $this->messageType = 'warning';
                    $this->redirect = route('maintenance.assets.meters.show', [$asset->id, $meter->id]);

                    return $this->response();
                }
            }

            if ($this->meterReading->setInput($data)->create()) {
                $this->message = 'Successfully updated reading';
                $this->messageType = 'success';
                $this->redirect = route('maintenance.assets.show', [$asset->id]);
            } else {
                $this->message = 'There was an error trying to update this meter. Please try again';
                $this->messageType = 'danger';
                $this->redirect = route('maintenance.assets.show', [$asset->id]);
            }
        } else {
            $this->errors = $this->meterReadingValidator->getErrors();
        }

        return $this->response();
    }

    public function destroy($asset_id, $meter_id, $reading_id)
    {
        $asset = $this->asset->find($asset_id);

        $meter = $this->meter->find($meter_id);

        $this->meterReading->destroy($reading_id);

        $this->message = 'Successfully deleted reading';
        $this->messageType = 'success';
        $this->redirect = route('maintenance.assets.meters.show', [$asset->id, $meter->id]);

        return $this->response();
    }
}
