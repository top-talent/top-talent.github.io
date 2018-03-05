<?php

namespace Stevebauman\Maintenance\Tests\Middleware;

use Stevebauman\Maintenance\Tests\FunctionalTestCase;

class AuthMiddlewareTest extends FunctionalTestCase
{
    public function testRedirect()
    {
        $this->call('GET', route('maintenance.work-orders.index'));

        $this->assertRedirectedToRoute('maintenance.login');

        $this->assertSessionHasErrors();
    }
}
