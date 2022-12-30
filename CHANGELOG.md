# Rinvex Support Change Log

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](CONTRIBUTING.md).


## [v6.1.5] - 2022-12-30
- Drop felixkiss/uniquewith-validator usage
  - This is no longer a requirement, and could be included on the project level if needed. 

## [v6.1.4] - 2022-12-30
- Drop `hashid` model attribute append to fix toArray issues in some scenarios, we can always call it explicitly if needed.

## [v6.1.3] - 2022-08-30
- Tweak hashids trait

## [v6.1.2] - 2022-08-06
- Tweak model IDs hashing to support configurable hashed keys

## [v6.1.1] - 2022-06-11
- Fix null string issue with strip_tags

## [v6.1.0] - 2022-02-14
- Update composer dependencies to Laravel v9
- Use PHP v8 nullsafe operator

## [v6.0.3] - 2022-01-02
- Update str global helpers to check for empty strings

## [v6.0.2] - 2021-12-20
- Add two new global helpers get_str_contains & get_str_endswith

## [v6.0.1] - 2021-10-05
- Refactor timezone getter/setter and fix related issues (fix #57)

## [v6.0.0] - 2021-08-22
- Drop PHP v7 support, and upgrade rinvex package dependencies to next major version
- Update composer dependencies

## [v5.0.19] - 2021-08-06
- Move application layer helpers to cortex/foundation module helpers (43bf9ad)
- Refactor accessarea obscure and indexable config options (7891a61)
- Refactor HashidsTrait ID obscuration (2b4125b)
- Update composer dependency codedungeon/phpunit-result-printer (08d9601)
- Rename areas to accessareas (8106779)

## [v5.0.18] - 2021-06-19
- Add array_diff_assoc_recursive global helper
- Allow modules to override core packages rules
- Update HasTranslations.php (#37)

## [v5.0.17] - 2021-05-26
- Set default status code to null, we'll handle it!

## [v5.0.16] - 2021-05-26
- Fix compatibility issue with diglactic/laravel-breadcrumbs V7

## [v5.0.15] - 2021-05-25
- Gracefully handle unset array identifiers

## [v5.0.14] - 2021-05-24
- Refactor `intend` function to return more accurate HTTP status codes

## [v5.0.13] - 2021-05-11
- Update spatie/laravel-schemaless-attributes composer dependency

## [v5.0.12] - 2021-05-04
- Catch static & non-static calls for static and non-static methods before calling macros

## [v5.0.11] - 2021-04-27
- Revert custom package to default felixkiss/uniquewith-validator
- Fix str_replace string conversion issue

## [v5.0.10] - 2021-03-15
- Fix timezone issue with created_at, updated_at, and automatically generated timestamp fields

## [v5.0.9] - 2021-03-15
- Revert "Fix user timezone conversion on read/update - ignore current user timezone when using setAttribute (#47)"

## [v5.0.8] - 2021-02-28
- Fix user timezone conversion on read/update - ignore current user timezone when using setAttribute (#47)

## [v5.0.7] - 2021-02-24
- Simplify and utilize request()->user() and request()->guard()
- Simplify and utilize request()->accessarea()
- Fix wrong http status code 0 on redirect response
- Add `unhashId` method to unhash hashids per model
- Refactor `intend` global helper to support API response better
- Move `get_access_area` global helper to `Request::getAccessArea` method
- Add `similar` collection macro

## [v5.0.6] - 2021-02-16
- Fix macroable conflict with dynamic relationships
- Refactor `get_access_area` global helper to support all possible scenarios:
    1. Route matched and is an accessarea request (ex. /adminarea/users)
    2. Route matched and is an API request (ex. /api/users)
    3. Catch other use cases:
       3.1. Route NOT matched / Wrong URL (ex. 404 error)
       3.2. Route matched but NOT a valid accessarea (could happen if route is mistakenly named, make sure route names contain valid accessarea prefix)

## [v5.0.5] - 2021-02-11
- Add ability for artisan commands to validate answers
- Add `get_access_area` helper function

## [v5.0.4] - 2021-02-06
- Simplify service provider model registration into IoC
- Enforce consistency

## [v5.0.3] - 2020-12-25
- Fix wrong composer dependency version constraints

## [v5.0.2] - 2020-12-25
- Switch outdated composer dependencies to temporary compatible forks until it's updated

## [v5.0.1] - 2020-12-25
- Add support for PHP v8

## [v5.0.0] - 2020-12-22
- Upgrade to Laravel v8

## [v4.3.1] - 2020-07-16
- Refactor timezone implementation to fix read/write date attributes

## [v4.3.0] - 2020-07-16
- Add HasTimezones trait to adjust per user profile
- Add timeoffset helper function and validation rule
- Use timezone_identifiers_list native PHP function instead of manually updated timezone list
- Append application name after page name in titles

## [v4.2.1] - 2020-06-20
- Add custom Macroable trait with Eloquent model support

## [v4.2.0] - 2020-06-19
- Fix request.guard binding issue when running in console

## [v4.1.1] - 2020-06-19
- Refactor route parameters to container service binding

## [v4.1.0] - 2020-06-15
- Add `mergeRules` method to ValidatingTrait
- Drop PHP 7.2 & 7.3 support from travis

## [v4.0.7] - 2020-05-30
- Remove default indent size config
- Add strip_tags validation rule to string fields
- Specify events queue
- Add strip_tags validation rule

## [v4.0.6] - 2020-04-12
- Fix ServiceProvider registerCommands method compatibility

## [v4.0.5] - 2020-04-09
- Tweak artisan command registration
- Reverse commit "Convert database int fields into bigInteger"
- Refactor publish command and allow multiple resource values

## [v4.0.4] - 2020-04-04
- Fix namespace issue

## [v4.0.3] - 2020-04-04
- Enforce consistent artisan command tag namespacing
- Enforce consistent package namespace
- Drop laravel/helpers usage as it's no longer used

## [v4.0.2] - 2020-03-20
- Convert into bigInteger database fields
- Add shortcut -f (force) for artisan publish commands
- Fix migrations path

## [v4.0.1] - 2020-03-16
- Update compatibility with Laravel v7.x

## [v4.0.0] - 2020-03-15
- Upgrade to Laravel v7.1.x & PHP v7.4.x

## [v3.0.4] - 2020-03-13
- Tweak TravisCI config
- Add migrations autoload option to the package
- Tweak service provider `publishesResources`
- Install felixkiss/uniquewith-validator composer package
- Ability to enable/disable hashing for each  model in any area without any need to enable/disable the whole area (#26)
- Remove indirect composer dependency
- Drop using global helpers
- Update StyleCI config

## [v3.0.3] - 2019-12-18
- Tweak ID obscure feature

## [v3.0.2] - 2019-09-24
- Add missing laravel/helpers composer package

## [v3.0.1] - 2019-09-23
- Fix outdated package version

## [v3.0.0] - 2019-09-23
- Upgrade to Laravel v6 and update dependencies

## [v2.1.1] - 2019-06-03
- Enforce latest composer package versions

## [v2.1.0] - 2019-06-02
- Update composer deps
- Drop PHP 7.1 travis test
- Add bunch of helpful console tools to be used in Service Providers

## [v2.0.0] - 2019-03-03
- Require PHP 7.2 & Laravel 5.8

## [v1.0.3] - 2019-01-03
- Tweak and simplify FormRequest validations

## [v1.0.2] - 2018-12-24
- Fix wrong translatable method name
- Rename environment variable QUEUE_DRIVER to QUEUE_CONNECTION

## [v1.0.1] - 2018-12-22
- Update composer dependencies
- Add PHP 7.3 support to travis

## [v1.0.0] - 2018-10-01
- Enforce Consistency
- Support Laravel 5.7+
- Rename package to rinvex/laravel-support

## [v0.0.5] - 2018-09-21
- Update travis php versions
- Drop incomplete Turbolinks-Location redirection and other useless code
- Add missing composer dependency
- Use global helper functions instead of class based methods
- Add HashidsTrait
- Add row escaper trait
- Rename "escapeRow" method to just "escape"
- Escape only string values, and skip others
- Add helper function to extract page titles from breadcrumbs
- Drop StyleCI multi-language support (paid feature now!)
- Update composer dependencies
- Conditionally obscure IDs for if enabled for accessarea
- Add HasSocialAttributes trait
- Prepare and tweak testing configuration
- Update StyleCI options
- Update PHPUnit options

## [v0.0.4] - 2018-02-18
- Remove duplicate and wrong Asia/Kathmandu timezone
- Add domain helper to get simplify domain host string
- Remove redundant functionality, replaced by default Laravel 5.4 middleware
- Use global helpers for response instead of the namepsaced class
- Remove useless service provider override
- Handle default translation if no locale supplied
- Update composer dependencies
- Enhance redirection method
- Update supplementary files
- Auto generate slugs on validating
- Fix HTTP response code condition
- Remove FormRequest override in favor for native prepareForValidation feature
- Add PHPUnitPrettyResultPrinter
- Fix redirection turbolinks issues
- Typehint method returns
- Fix redirection JSON response
- Return only first translation of translatable attributes
- Add Laravel v5.6 support
- Drop Laravel 5.5 support

## [v0.0.3] - 2017-03-14
- Update readme and composer dependencies
- Update StyleCI fixers and other supplementary files
- Enforce strict type declaration
- Fix stupid gitattributes export-ignore issues

## [v0.0.2] - 2016-12-27
- Fix readme typo
- Enforce strict mode
- Fix installation typo
- Trim and filter request inputs recursively
- Add two new functions for array trim recursive and array filter recursive

## v0.0.1 - 2016-12-20
- Tag first release

[v6.1.5]: https://github.com/rinvex/laravel-support/compare/v6.1.4...v6.1.5
[v6.1.4]: https://github.com/rinvex/laravel-support/compare/v6.1.3...v6.1.4
[v6.1.3]: https://github.com/rinvex/laravel-support/compare/v6.1.2...v6.1.3
[v6.1.2]: https://github.com/rinvex/laravel-support/compare/v6.1.1...v6.1.2
[v6.1.1]: https://github.com/rinvex/laravel-support/compare/v6.1.0...v6.1.1
[v6.1.0]: https://github.com/rinvex/laravel-support/compare/v6.0.3...v6.1.0
[v6.0.3]: https://github.com/rinvex/laravel-support/compare/v6.0.2...v6.0.3
[v6.0.2]: https://github.com/rinvex/laravel-support/compare/v6.0.1...v6.0.2
[v6.0.1]: https://github.com/rinvex/laravel-support/compare/v6.0.0...v6.0.1
[v6.0.0]: https://github.com/rinvex/laravel-support/compare/v5.0.19...v6.0.0
[v5.0.19]: https://github.com/rinvex/laravel-support/compare/v5.0.18...v5.0.19
[v5.0.18]: https://github.com/rinvex/laravel-support/compare/v5.0.17...v5.0.18
[v5.0.17]: https://github.com/rinvex/laravel-support/compare/v5.0.16...v5.0.17
[v5.0.16]: https://github.com/rinvex/laravel-support/compare/v5.0.15...v5.0.16
[v5.0.15]: https://github.com/rinvex/laravel-support/compare/v5.0.14...v5.0.15
[v5.0.14]: https://github.com/rinvex/laravel-support/compare/v5.0.13...v5.0.14
[v5.0.13]: https://github.com/rinvex/laravel-support/compare/v5.0.12...v5.0.13
[v5.0.12]: https://github.com/rinvex/laravel-support/compare/v5.0.11...v5.0.12
[v5.0.11]: https://github.com/rinvex/laravel-support/compare/v5.0.10...v5.0.11
[v5.0.10]: https://github.com/rinvex/laravel-support/compare/v5.0.9...v5.0.10
[v5.0.9]: https://github.com/rinvex/laravel-support/compare/v5.0.8...v5.0.9
[v5.0.8]: https://github.com/rinvex/laravel-support/compare/v5.0.7...v5.0.8
[v5.0.7]: https://github.com/rinvex/laravel-support/compare/v5.0.6...v5.0.7
[v5.0.6]: https://github.com/rinvex/laravel-support/compare/v5.0.5...v5.0.6
[v5.0.5]: https://github.com/rinvex/laravel-support/compare/v5.0.4...v5.0.5
[v5.0.4]: https://github.com/rinvex/laravel-support/compare/v5.0.3...v5.0.4
[v5.0.3]: https://github.com/rinvex/laravel-support/compare/v5.0.2...v5.0.3
[v5.0.2]: https://github.com/rinvex/laravel-support/compare/v5.0.1...v5.0.2
[v5.0.1]: https://github.com/rinvex/laravel-support/compare/v5.0.0...v5.0.1
[v5.0.0]: https://github.com/rinvex/laravel-support/compare/v4.3.1...v5.0.0
[v4.3.1]: https://github.com/rinvex/laravel-support/compare/v4.3.0...v4.3.1
[v4.3.0]: https://github.com/rinvex/laravel-support/compare/v4.2.1...v4.3.0
[v4.2.1]: https://github.com/rinvex/laravel-support/compare/v4.2.0...v4.2.1
[v4.2.0]: https://github.com/rinvex/laravel-support/compare/v4.1.1...v4.2.0
[v4.1.1]: https://github.com/rinvex/laravel-support/compare/v4.1.0...v4.1.1
[v4.1.0]: https://github.com/rinvex/laravel-support/compare/v4.0.7...v4.1.0
[v4.0.7]: https://github.com/rinvex/laravel-support/compare/v4.0.6...v4.0.7
[v4.0.6]: https://github.com/rinvex/laravel-support/compare/v4.0.5...v4.0.6
[v4.0.5]: https://github.com/rinvex/laravel-support/compare/v4.0.4...v4.0.5
[v4.0.4]: https://github.com/rinvex/laravel-support/compare/v4.0.3...v4.0.4
[v4.0.3]: https://github.com/rinvex/laravel-support/compare/v4.0.2...v4.0.3
[v4.0.2]: https://github.com/rinvex/laravel-support/compare/v4.0.1...v4.0.2
[v4.0.1]: https://github.com/rinvex/laravel-support/compare/v4.0.0...v4.0.1
[v4.0.0]: https://github.com/rinvex/laravel-support/compare/v3.0.4...v4.0.0
[v3.0.4]: https://github.com/rinvex/laravel-support/compare/v3.0.3...v3.0.4
[v3.0.3]: https://github.com/rinvex/laravel-support/compare/v3.0.2...v3.0.3
[v3.0.2]: https://github.com/rinvex/laravel-support/compare/v3.0.1...v3.0.2
[v3.0.1]: https://github.com/rinvex/laravel-support/compare/v3.0.0...v3.0.1
[v3.0.0]: https://github.com/rinvex/laravel-support/compare/v2.1.1...v3.0.0
[v2.1.1]: https://github.com/rinvex/laravel-support/compare/v2.1.0...v2.1.1
[v2.1.0]: https://github.com/rinvex/laravel-support/compare/v2.0.0...v2.1.0
[v2.0.0]: https://github.com/rinvex/laravel-support/compare/v1.0.3...v2.0.0
[v1.0.3]: https://github.com/rinvex/laravel-support/compare/v1.0.2...v1.0.3
[v1.0.2]: https://github.com/rinvex/laravel-support/compare/v1.0.1...v1.0.2
[v1.0.1]: https://github.com/rinvex/laravel-support/compare/v1.0.0...v1.0.1
[v1.0.0]: https://github.com/rinvex/laravel-support/compare/v0.0.5...v1.0.0
[v0.0.5]: https://github.com/rinvex/laravel-support/compare/v0.0.4...v0.0.5
[v0.0.4]: https://github.com/rinvex/laravel-support/compare/v0.0.3...v0.0.4
[v0.0.3]: https://github.com/rinvex/laravel-support/compare/v0.0.2...v0.0.3
[v0.0.2]: https://github.com/rinvex/laravel-support/compare/v0.0.1...v0.0.2
