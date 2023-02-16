<?php

namespace Webapix\GLS\Laravel;

use Webapix\GLS\Client as GlsClient;
use Webapix\GLS\Contracts\Account as AccountContract;
use Webapix\GLS\Contracts\Request;
use Webapix\GLS\Contracts\Response;
use Webapix\GLS\Models\Account;

class Client
{
    /**
     * @var GlsClient
     */
    protected $client;

    public function __construct(GlsClient $client)
    {
        $this->client = $client;
    }

    public function on(string $account): self
    {
        $accountConfig = config('my-gls.accounts.'.$account);

        if (! $accountConfig) {
            throw new AccountNotFoundException('Account ['.$account.'] not found!');
        }

        return $this->onAccount(new Account(
            $accountConfig['api_url'],
            $accountConfig['client_number'],
            $accountConfig['username'],
            $accountConfig['password']
        ));
    }

    public function onAccount(AccountContract $account): self
    {
        tap($this->client)->on($account);

        return $this;
    }

    public function request(Request $request): Response
    {
        return $this->client->request($request);
    }
}
