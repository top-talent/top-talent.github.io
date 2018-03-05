<?php

namespace App\Processors;

use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;

abstract class Processor
{
    use DispatchesJobs, AuthorizesRequests;

    /**
     * Presenter instance.
     *
     * @var object
     */
    protected $presenter;

    /**
     * Throws an unauthorized exception.
     *
     * @param string|null $error
     *
     * @throws UnauthorizedException
     */
    public function unauthorized($error = null)
    {
        throw new UnauthorizedException($error);
    }
}
