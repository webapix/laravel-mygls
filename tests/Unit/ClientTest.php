<?php

namespace Webapix\GLS\Laravel\Tests\Unit;

use Mockery as m;
use Webapix\GLS\Contracts\Request;
use Webapix\GLS\Laravel\AccountNotFoundException;
use Webapix\GLS\Laravel\Client;
use Webapix\GLS\Laravel\Tests\TestCase;
use Webapix\GLS\Models\Account;
use Webapix\GLS\Requests\GetParcelStatuses;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    protected $client;

    protected $mockClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockClient = m::mock(\Webapix\GLS\Client::class);
        $this->client = new Client($this->mockClient);
    }

    /** @test */
    public function it_can_set_the_account_object()
    {
        $account = new Account(
            'https://api.test.mygls.hu/ParcelService.svc/json/',
            '1234567',
            'test',
            'test'
        );

        $this->mockClient->shouldReceive('on')
            ->once()
            ->with($account);

        $client = $this->client->onAccount($account);

        $this->assertInstanceOf(Client::class, $client);
    }

    /** @test */
    public function it_can_set_the_account_by_config()
    {
        config(['my-gls.accounts.new' => [
            'api_url' => 'https://api.test.mygls.hu/ParcelService.svc/json/',
            'client_number' => '54321',
            'username' => 'testNew',
            'password' => 'testNew',
        ]]);

        $this->mockClient->shouldReceive('on')
            ->once()
            ->with(m::on(function ($arg) {
                return $arg->userName() === 'testNew'
                    && is_array($arg->passwordHash())
                    && $arg->clientNumber() === '54321'
                    && $arg->apiUrl() === 'https://api.test.mygls.hu/ParcelService.svc/json/';
            }));

        $this->client->on('new');
    }

    /** @test */
    public function it_can_perform_a_request()
    {
        $this->mockClient->shouldReceive('request')
            ->once()
            ->with(m::on(function ($arg) {
                return $arg instanceof Request;
            }));

        $this->client->request(new GetParcelStatuses('123456789'));
    }

    /** @test */
    public function it_throw_an_exception_if_account_not_found()
    {
        $this->expectException(AccountNotFoundException::class);

        $this->client->on('not-exists-account');
    }
}
