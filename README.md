# Rapture PHP Session

[![PhpVersion](https://img.shields.io/badge/php-5.4.0-orange.svg?style=flat-square)](#)
[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](#)

Simple templates for PHP.

## Requirements

- PHP v5.4.0
- php-session

## Install

```
composer require mrjulio/rapture-session
```

## Quick start

```php
$session = new \Rapture\Session\Adapter\Php;
$session->set('user', 'John');
$session->get('user');
```

## About

### Author

Iulian N. `rapture@iuliann.ro`

### Testing

```
cd ./test && phpunit
```

### License

Rapture Session is licensed under the MIT License - see the `LICENSE` file for details.
