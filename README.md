# Laravel MyGLS JSON REST API
[![Build Status](https://travis-ci.com/webapix/laravel-mygls.svg?branch=master)](https://travis-ci.com/webapix/laravel-mygls)
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
PF.: 941   
1535 Budapest   
Hungary

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