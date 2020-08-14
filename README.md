# Google Cloud JWT Authentication

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tradecoverexchange/google-cloud-jwt-validator.svg?style=flat-square)](https://packagist.org/packages/tradecoverexchange/google-cloud-jwt-validator)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/tradecoverexchange/google-cloud-jwt-validator/Tests?label=tests)](https://github.com/tradecoverexchange/google-cloud-jwt-validator/actions?query=workflow%3ATests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/tradecoverexchange/google-cloud-jwt-validator.svg?style=flat-square)](https://packagist.org/packages/tradecoverexchange/google-cloud-jwt-validator)

A package for validating the authenticity of incoming Google Cloud requests such as those used by
Google Cloud Tasks or Google Cloud Scheduler. Laravel supported.

## Installation

You can install the package via composer:

```bash
composer require tradecoverexchange/google-cloud-jwt-validator
```

## Usage

The only implementation so far is with Laravel. It can be used as a middleware to block requests
without a valid JWT authentication token.

``` php
<?php // routes/web.php

Route::get('/')
    ->middleware(
        \TradeCoverExchange\GoogleJwtVerifier\Laravel\GoogleJwtVerifier::middleware('server_account_email@google.com')
    );
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## About Us

[Trade Cover Exchange](https://tradecoverexchange.com) is a platform for insuring your trade
with other companies, protecting you from instabilities in the supply chain.

We proudly use the Google Cloud platform for our service and hope to share more of our work with
the developer community in the future.

## Security

If you discover any security related issues, please email peter@tradecoverexchange.com instead of using the issue tracker.

## Credits

- [Peter Fox](https://github.com/peterfox)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
