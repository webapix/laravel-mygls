<?php

namespace Webapix\GLS\Laravel;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Webapix\GLS\Laravel\Client on(string $account)
 * @method static \Webapix\GLS\Laravel\Client onAccount(\Webapix\GLS\Contracts\Account $account)
 * @method static \Webapix\GLS\Contracts\Response request(\Webapix\GLS\Contracts\Request $account)
 */
class MyGls extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Client::class;
    }
}
