# Rinvex Support Change Log

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](CONTRIBUTING.md).


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

[v0.0.4]: https://github.com/rinvex/support/compare/v0.0.3...v0.0.4
[v0.0.3]: https://github.com/rinvex/support/compare/v0.0.2...v0.0.3
[v0.0.2]: https://github.com/rinvex/support/compare/v0.0.1...v0.0.2
