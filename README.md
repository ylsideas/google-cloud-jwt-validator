# Google Cloud JWT Authentication

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ylsideas/google-cloud-jwt-validator.svg?style=flat-square)](https://packagist.org/packages/ylsideas/google-cloud-jwt-validator)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ylsideas/google-cloud-jwt-validator/run-tests?label=tests)](https://github.com/ylsideas/google-cloud-jwt-validator/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ylsideas/google-cloud-jwt-validator/Check%20&%20fix%20styling?label=code%20style)](https://github.com/ylsideas/google-cloud-jwt-validator/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ylsideas/google-cloud-jwt-validator.svg?style=flat-square)](https://packagist.org/packages/ylsideas/google-cloud-jwt-validator)


A package for validating the authenticity of incoming Google Cloud requests such as those used by
Google Cloud Tasks or Google Cloud Scheduler. Laravel supported.

## Installation

You can install the package via composer:

```bash
composer require ylsideas/google-cloud-jwt-validator
```

## Usage

The only implementation so far is with Laravel. It can be used as a middleware to block requests
without a valid JWT authentication token.

``` php
<?php // routes/web.php

Route::get('/')
    ->middleware(
        \YlsIdeas\GoogleJwtVerifier\Laravel\AuthenticateByOidc::middleware('server_account_email@google.com')
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

![Trade Cover Exchange](https://assets.tradecoverexchange.com/github/TradeCoverExchange_RGB_Logo_Outline_Stacked.png)

[Trade Cover Exchange](https://tradecoverexchange.com) is a platform for insuring your trade
with other companies, protecting you from instabilities in the supply chain.

We proudly use the Google Cloud platform for our service and hope to share more of our work with
the developer community in the future.

## Security

If you discover any security related issues, please email peter@tradecoverexchange.com instead of using the issue tracker.

## Credits

- [Peter Fox](https://github.com/peterfox)
- [Kees van Bemmel](https://github.com/kees-tce)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
