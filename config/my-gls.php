<?php

return [
    'accounts' => [
        'default' => [
            'api_url' => env('MYGLS_API_URL', 'https://api.test.mygls.hu/ParcelService.svc/json/'),
            'client_number' => env('MYGLS_CLIENT_NUMBER', '100000001'),
            'username' => env('MYGLS_USERNAME', 'myglsapitest@test.mygls.hu'),
            'password' => env('MYGLS_PASSWORD', '1pImY_gls.hu'),
        ],
        //
    ],
];
