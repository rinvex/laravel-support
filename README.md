# Rinvex Support

**Rinvex common** support helpers, contracts, and traits required by various Rinvex packages. Validator functionality, and basic controller included out-of-the-box.

[![Packagist](https://img.shields.io/packagist/v/rinvex/support.svg?label=Packagist&style=flat-square)](https://packagist.org/packages/rinvex/support)
[![License](https://img.shields.io/packagist/l/rinvex/support.svg?label=License&style=flat-square)](https://github.com/rinvex/support/blob/develop/LICENSE)
[![VersionEye Dependencies](https://img.shields.io/versioneye/d/php/rinvex:support.svg?label=Dependencies&style=flat-square)](https://www.versioneye.com/php/rinvex:support/)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/rinvex/support.svg?label=Scrutinizer&style=flat-square)](https://scrutinizer-ci.com/g/rinvex/support/)
[![Code Climate](https://img.shields.io/codeclimate/github/rinvex/support.svg?label=CodeClimate&style=flat-square)](https://codeclimate.com/github/rinvex/support)
[![StyleCI](https://styleci.io/repos/60968880/shield)](https://styleci.io/repos/60968880)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/21b922e5-faa9-4773-ac8e-5ab55229d36c.svg?label=SensioLabs&style=flat-square)](https://insight.sensiolabs.com/projects/21b922e5-faa9-4773-ac8e-5ab55229d36c)

> **Note:** this package is just a support package for other Rinvex packages, which may not be useful on it's own, but contains some complementary geberic functionality and also may not respect SemVer.


## Installation

Install via `composer require rinvex/category`


## Usage

## Support Helpers

### `intend()`

The `intend` method returns redirect response:
```php
intend([
    'route' => 'route.name.here',
    'withErrors' => ['error.message.id' => 'A custom error message'],
]);
```

> **Note:** this helper accepts `redirect` methods as it's input keys, such as `withErrors`, `with`, `back`, and `route` ..etc

### `lower_case()`

The `lower_case` method converts the given string to lower-case:
```php
$lowercaseStr = upper_case('THIS UPPER CASE TEXT WILL BE LOWER CASED');
```

### `upper_case()`

The `upper_case` method converts the given string to upper-case:
```php
$uppercaseStr = upper_case('this lower case text will be capitalized');
```

### `mimetypes()`

The `mimetypes` method gets valid mime types:
```php
$mimetypes = mimetypes();
```

### `timezones()`

The `timezones` method gets valid timezones:
```php
$timezones = timezones();
```


## Changelog

Refer to the [Changelog](CHANGELOG.md) for a full history of the project.


## Support

The following support channels are available at your fingertips:

- [Chat on Slack](http://chat.rinvex.com)
- [Help on Email](mailto:help@rinvex.com)
- [Follow on Twitter](https://twitter.com/rinvex)


## Contributing & Protocols

Thank you for considering contributing to this project! The contribution guide can be found in [CONTRIBUTING.md](CONTRIBUTING.md).

Bug reports, feature requests, and pull requests are very welcome.

- [Versioning](CONTRIBUTING.md#versioning)
- [Pull Requests](CONTRIBUTING.md#pull-requests)
- [Coding Standards](CONTRIBUTING.md#coding-standards)
- [Feature Requests](CONTRIBUTING.md#feature-requests)
- [Git Flow](CONTRIBUTING.md#git-flow)


## Security Vulnerabilities

We want to ensure that this package is secure for everyone. If you've discovered a security vulnerability in this package, we appreciate your help in disclosing it to us in a [responsible manner](https://en.wikipedia.org/wiki/Responsible_disclosure).

Publicly disclosing a vulnerability can put the entire community at risk. If you've discovered a security concern, please email us at [security@rinvex.com](mailto:security@rinvex.com). We'll work with you to make sure that we understand the scope of the issue, and that we fully address your concern. We consider correspondence sent to [security@rinvex.com](mailto:security@rinvex.com) our highest priority, and work to address any issues that arise as quickly as possible.

After a security vulnerability has been corrected, a security hotfix release will be deployed as soon as possible.


## About Rinvex

Rinvex is a software solutions startup, specialized in integrated enterprise solutions for SMEs established in Alexandria, Egypt since June 2016. We believe that our drive The Value, The Reach, and The Impact is what differentiates us and unleash the endless possibilities of our philosophy through the power of software. We like to call it Innovation At The Speed Of Life. That’s how we do our share of advancing humanity.


## License

This software is released under [The MIT License (MIT)](LICENSE).

(c) 2016-2017 Rinvex LLC, Some rights reserved.
