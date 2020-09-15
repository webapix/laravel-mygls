<?php

namespace Webapix\GLS\Laravel\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Webapix\GLS\Laravel\MyGlsServiceProvider;

/**
 * Class TestCase.
 */
class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->publishConfigs();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            MyGlsServiceProvider::class,
        ];
    }

    protected function publishConfigs()
    {
        $this->artisan('vendor:publish', [
            '--provider' => MyGlsServiceProvider::class,
            '--tag' => 'config',
        ]);
    }
}
