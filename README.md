# Laravel MyGLS JSON REST API
[![Tests](https://github.com/webapix/laravel-mygls/workflows/Tests/badge.svg)](https://github.com/webapix/laravel-mygls/actions?query=workflow%3ATests+branch%3Amaster)
[![StyleCI](https://github.styleci.io/repos/295681631/shield?branch=master)](https://github.styleci.io/repos/295681631?branch=master)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

This is the Laravel version of our [MyGLS REST API integration](https://github.com/webapix/mygls-sdk).

## Installation

You can install the package via composer:

```bash
composer require webapix/laravel-mygls
```

## Configuration

### Publish package

Create config/my-gls.php configuration file using the following artisan command:

```bash
php artisan vendor:publish --provider="Webapix\GLS\Laravel\MyGlsServiceProvider"
```

### Add your account

Open .env file and set:

MYGLS_API_URL  
MYGLS_CLIENT_NUMBER  
MYGLS_USERNAME  
MYGLS_PASSWORD  

## Usage

``` php
use \Webapix\GLS\Requests\GetParcelStatuses;

$request = new GetParcelStatuses(12345678);

/** @var \Webapix\GLS\Responses\GetParcelStatuses $response */
$response = app(\Webapix\GLS\Laravel\Client::class)->request($request);
// Or use the facade: $response = MyGls::request($request);

if ($response->successfull()) {

    /** @var \Webapix\GLS\Models\ParcelStatus[] */
    $parcelStatusList = $response->parcelStatusList();

    foreach ($parcelStatusList as $parcelStatus) {
        $parcelStatus->depotCity();
        $parcelStatus->depotNumber();
        $parcelStatus->statusCode();
        $parcelStatus->statusDate();
        $parcelStatus->statusDescription();
        $parcelStatus->statusInfo();
    }

}
```

You can find more information and examples in our [wiki](https://github.com/webapix/mygls-sdk/wiki).

### Accounts

By default, the MyGLS client use the default account.

You can use multiple accounts:

``` php
// add your new account to config/my-gls.php
[
    'accounts' => [
        'my-new-account' => [
            'api_url' => '',
            'client_number' => '',
            'username' => '',
            'password' => '',
        ]
    ]
]

MyGls::on('my-new-account')->request(...);
```

## Docs
[Package docs](https://github.com/webapix/mygls-sdk/wiki)  
[Official GLS Docs](https://api.mygls.hu/)
## Testing

``` bash
composer test
```

## Postcardware
According to the postcardware concept, if you use the software for your project(s) we would appreciate to receive a postcard of your hometown.

Please send it to:

WEBAPIX KFT.
Kőris utca 2/E, 2/1  
2051 Biatorbágy  
Hungary

## Support us

If you find our packages useful and would like to support our work in maintaining and regularly updating them, consider becoming a patron. Any size of donation is welcome and highly appreciated.

## Contributing

Contributions are welcome! When contributing to this repository, please first discuss the change you wish to make via issue, email, or any other method with the owners of this repository before making a change.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

If you discover any security related issues, please email pdo@webapix.hu instead of using the issue tracker.

## Credits

- [WEBAPIX Kft.](https://webapix.hu)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
