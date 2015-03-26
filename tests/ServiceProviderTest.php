<?php

use \Orchestra\Testbench\TestCase;

class ServiceProviderTest extends TestCase {
    
    public function setUp()
    {
        parent::setUp();
    }

    public function testServiceProvider() {
        $this->app->bind('\Illuminate\Contracts\Auth\UserProvider', '\Ifaniqbal\Sysguard\SentryUserProvider');
        $this->app->instance('sysguard', $this->app->make('\Ifaniqbal\Sysguard\Sysguard'));

        $this->app->alias('sysguard', '\Ifaniqbal\Sysguard\Sysguard');

        $this->assertInstanceOf('Illuminate\Auth\Guard', $this->app['sysguard']);
        $this->assertInstanceOf('\Ifaniqbal\Sysguard\Sysguard', $this->app['sysguard']);
    }
}