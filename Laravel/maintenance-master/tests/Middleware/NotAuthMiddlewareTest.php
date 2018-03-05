<?php

namespace Stevebauman\Maintenance\Tests\Middleware;

use Stevebauman\Maintenance\Tests\FunctionalTestCase;

class NotAuthMiddlewareTest extends FunctionalTestCase
{
    public function testRedirect()
    {
        $this->setUserIsAdmin();
    }
}
