# Smartgas Authorizarion

## Installation & Usage

### Requirements

PHP 8.2 and later.

To install the bindings via [Composer](https://getcomposer.org/):

```
composer require ruslan_sgs/smartgas-lib-auth:dev-main --with-all-dependencies
```

Then run


```
php artisan vendor:publish --force
```

From the list select Ruslan_sgs\SmartgasLibAuth\Providers\AuthProvider

## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author

ersatama@gmail.com
