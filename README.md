# Rinvex Support

**Rinvex common** support helpers, contracts, and traits required by various Rinvex packages. Validator functionality, and basic controller included out-of-the-box.

[![Packagist](https://img.shields.io/packagist/v/rinvex/support.svg?label=Packagist&style=flat-square)](https://packagist.org/packages/rinvex/support)
[![License](https://img.shields.io/packagist/l/rinvex/support.svg?label=License&style=flat-square)](https://github.com/rinvex/support/blob/develop/LICENSE)
[![VersionEye Dependencies](https://img.shields.io/versioneye/d/php/rinvex:support.svg?label=Dependencies&style=flat-square)](https://www.versioneye.com/php/rinvex:support/)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/rinvex/support.svg?label=Scrutinizer&style=flat-square)](https://scrutinizer-ci.com/g/rinvex/support/)
[![Code Climate](https://img.shields.io/codeclimate/github/rinvex/support.svg?label=CodeClimate&style=flat-square)](https://codeclimate.com/github/rinvex/support)
[![StyleCI](https://styleci.io/repos/49874431/shield)](https://styleci.io/repos/49874431)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/da6c0f03-ea00-46ed-8f7b-a20ee721cad5.svg?label=SensioLabs&style=flat-square)](https://insight.sensiolabs.com/projects/da6c0f03-ea00-46ed-8f7b-a20ee721cad5)


## Table Of Contents

- [Installation](#installation)
    - [Compatibility](#compatibility)
    - [Prerequisites](#prerequisites)
    - [Require Package](#require-package)
    - [Install Dependencies](#install-dependencies)
- [Integration](#integration)
    - [Native Integration](#native-integration)
    - [Laravel Integration](#laravel-integration)
- [Usage](#usage)
    - [Redirectable Trait](#redirectable-trait)
    - [Validateable Trait](#validateable-trait)
        - [`setValidationFactory()`, `getValidationFactory()`](#setvalidationfactory-getvalidationfactory)
        - [`setValidationRules()`, `getValidationRules()`](#setvalidationrules-getvalidationrules)
        - [`setValidationMessages()`, `getValidationMessages()`](#setvalidationmessages-getvalidationmessages)
        - [`setValidationCustomAttributes()`, `getValidationCustomAttributes()`](#setvalidationcustomattributes-getvalidationcustomattributes)
        - [`setValidationBindings()`, `getValidationBindings()`](#setvalidationbindings-getvalidationbindings)
        - [`validate()`](#validate)
    - [Support Helpers
        - [`lower_case()`](#lower_case)
        - [`upper_case()`](#upper_case)
        - [`mimetypes()`](#mimetypes)
        - [`timezones()`](#timezones)
- [Changelog](#changelog)
- [Support](#support)
- [Contributing & Protocols](#contributing--protocols)
- [Security Vulnerabilities](#security-vulnerabilities)
- [About Rinvex](#about-rinvex)
- [License](#license)


## Installation

The best and easiest way to install this package is through [Composer](https://getcomposer.org/).

### Compatibility

This package fully compatible with **Laravel** `5.1.*`, and `5.2.*`.

While this package tends to be framework-agnostic, it embraces Laravel culture and best practices to some extent. It's tested mainly with Laravel but you still can use it with other frameworks or even without any framework if you want.

### Prerequisites

```json
"php": ">=5.5.9",
"illuminate/bus": "5.1.*|5.2.*",
"illuminate/http": "5.1.*|5.2.*",
"illuminate/support": "5.1.*|5.2.*",
"illuminate/contracts": "5.1.*|5.2.*",
"illuminate/validation": "5.1.*|5.2.*",
"illuminate/routing": "5.1.*|5.2.*",
"illuminate/auth": "5.1.*|5.2.*"
```

### Require Package

Open your application's `composer.json` file and add the following line to the `require` array:
```json
"rinvex/support": "1.0.*"
```

> **Note:** Make sure that after the required changes your `composer.json` file is valid by running `composer validate`.

### Install Dependencies

On your terminal run `composer install` or `composer update` command according to your application's status to install the new requirements.

> **Note:** Checkout Composer's [Basic Usage](https://getcomposer.org/doc/01-basic-usage.md) documentation for further details.


## Integration

**Rinvex Support** package is framework-agnostic and as such can be integrated easily natively or with your favorite framework.

### Native Integration

Integrating the package outside of a framework is incredibly easy, just require the `vendor/autoload.php` file to autoload the package.

> **Note:** Checkout Composer's [Autoloading](https://getcomposer.org/doc/01-basic-usage.md#autoloading) documentation for further details.

### Laravel Integration

Integrating the package inside Laravel framework takes much less work, actually it doesn't require any integration steps after installation. Just jump directly to the [Usage](#usage) section. Awesome, huh?


## Usage

### Redirectable Trait

The `Rinvex\Support\Traits\Redirectable` provides an easy way to redirect users efficiently and get appropriate response depending on wether it's ajax or normal request. First, your class MUST implement the appropriate interface and use the corresponding trait:
```php
use Rinvex\Support\Traits\Redirectable;
use Rinvex\Support\Contracts\RedirectionContract;

class FooController implements RedirectionContract
{
    use Redirectable;
}
```

Redirect users to the previous page with flash message:
```php
return $this->redirect([
    'back' => true,
    'with' => ['status' => 'Action failed!'],
]);
```

Redirect users to the home page with flash error message:
```php
return $this->redirect([
    'home'       => true,
    'withErrors' => ['no_permission' => 'Sorry, you do not have appropriate permissions!'],
]);
```

> **Note:** The `Rinvex\Support\Traits\Redirectable` trait works intuitively like Laravel's standard redirect helper `redirect()`, so it takes same default arguments. It's just a wrapper around Laravel's `redirect()` helper with some extra functionality like checking request type (ajax/normal) and return response accordingly.


### Validateable Trait

The `Rinvex\Support\Traits\Validateable` trait provides a fluent, convenient wrapper for working with data validation. First, your class MUST implement the appropriate interface and use the corresponding trait:
```php
use Rinvex\Support\Traits\Validateable;
use Rinvex\Support\Contracts\ValidationContract;

class FooController implements ValidationContract
{
    use Validateable;
}
```

#### `setValidationFactory()`, `getValidationFactory()`

The `setValidationFactory` method sets the validation factory instance, while `getValidationFactory` returns it:
```php
// Require validation contract
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

// Inistantiate validator instance
$validator = app(ValidationFactory::class);

// Set the validation factory instance
$validator->setValidationFactory($validator);

// Get the validation factory instance
$validator->getValidationFactory();
```

#### `setValidationRules()`, `getValidationRules()`

The `setValidationRules` method sets the validation rules, while `getValidationRules` returns it:
```php
// Set validation rules
$this->setValidationRules(['name' => 'required', 'email' => 'required|email|{{foo}}']);

// Get validation rules
$this->getValidationRules();
```

> **Note:** The `{{foo}}` variable is NOT native validation rule, it's a placeholder that will be bound and resolved later, see the following section [`setValidationBindings()`, `getValidationBindings()`](#setvalidationbindings-getvalidationbindings) for more details.

#### `setValidationMessages()`, `getValidationMessages()`

The `setValidationMessages` method sets the validation messages, while `getValidationMessages` returns it:
```php
// Set validation messages
$this->setValidationMessages(['name' => 'name is required', 'email' => 'email is required']);

// Get validation messages
$this->getValidationMessages();
```

#### `setValidationCustomAttributes()`, `getValidationCustomAttributes()`

The `setValidationCustomAttributes` method sets the validation custom attributes, while `getValidationCustomAttributes` returns it:
```php
// Set custom validation attributes
$this->setValidationCustomAttributes(['first_name' => 'First Name', 'last_name'  => 'Last Name']);

// Get custom validation attributes
$this->getValidationCustomAttributes();
```

#### `setValidationBindings()`, `getValidationBindings()`

The `setValidationBindings` method sets the validation bindings, while `getValidationBindings` returns it:
```php
// Set the validation bindings
$this->setValidationBindings(['foo' => 'alpha']);

// Get the validation bindings
$this->getValidationBindings();
```

> **Note:** The `{{foo}}` variable was mentioned before in the previous section [`setValidationRules()`, `getValidationRules()`](#setValidationRules-getValidationRules), and it's time now to bind and resolve it. The validation rule now is processed as `required|email|alpha`. It's useful for some scenarios like verifying uniqueness and dynamic validation rules.

#### `validate()`

The `validate` method validates passed data, it's where the real validation work happen and it returns a validator instance:
```php
// Validate passed data
$validator = $this->validate(['name' => 'Somebody', 'email' => 'test@example.com']);

// Check if validation fails
if ($validator->fails()) {
    // Do something
}
```


## Support Helpers

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

> **Note:** This package follows the FIG PHP Standards Recommendations compliant with the [PSR-1: Basic Coding Standard](http://www.php-fig.org/psr/psr-1/), [PSR-2: Coding Style Guide](http://www.php-fig.org/psr/psr-2/) and [PSR-4: Autoloader](http://www.php-fig.org/psr/psr-4/) to ensure a high level of interoperability between shared PHP code.


## Changelog

Refer to the [Changelog](CHANGELOG.md) for a full history of the project.


## Support

The following support channels are available at your fingertips:

- [Chat](https://gitter.im/rinvex/chat)
- [Email](mailto:help@rinvex.com)
- [Twitter](https://twitter.com/rinvex)


## Contributing & Protocols

Thank you for considering contributing to this project! The contribution guide can be found in [CONTRIBUTING.md](CONTRIBUTING.md).

Bug reports, feature requests, and pull requests are very welcome.

- [Versioning](CONTRIBUTING.md#versioning)
- [Support Policy](CONTRIBUTING.md#support-policy)
- [Coding Standards](CONTRIBUTING.md#coding-standards)
- [Pull Requests](CONTRIBUTING.md#pull-requests)


## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to help@rinvex.com. All security vulnerabilities will be promptly addressed.


## About Rinvex

Rinvex is a software solutions startup, specialized in integrated enterprise solutions for SMEs established in Alexandria, Egypt since June 2016. We believe that our drive The Value, The Reach, and The Impact is what differentiates us and unleash the endless possibilities of our philosophy through the power of software. We like to call it Innovation At The Speed Of Life. That’s how we do our share of advancing humanity.


## License

This software is released under [The MIT License (MIT)](LICENSE).

(c) 2016 Rinvex LLC, Some rights reserved.
