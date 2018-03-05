<?php

namespace Stevebauman\Maintenance\Tests;

class WelcomeTest extends FunctionalTestCase
{
    public function testIndex()
    {
        $this->visit(route('maintenance.welcome.index'))->see('Login');
    }
}
