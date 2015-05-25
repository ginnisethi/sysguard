## Sysguard

[![Latest Stable Version](https://poser.pugx.org/ifaniqbal/sysguard/v/stable)](https://packagist.org/packages/ifaniqbal/sysguard) 
[![Total Downloads](https://poser.pugx.org/ifaniqbal/sysguard/downloads)](https://packagist.org/packages/ifaniqbal/sysguard)
[![Latest Unstable Version](https://poser.pugx.org/ifaniqbal/sysguard/v/unstable)](https://packagist.org/packages/ifaniqbal/sysguard) 
[![License](https://poser.pugx.org/ifaniqbal/sysguard/license)](https://packagist.org/packages/ifaniqbal/sysguard)
[![Build Status](https://travis-ci.org/ifaniqbal/sysguard.svg?branch=master)](https://travis-ci.org/ifaniqbal/sysguard)


Extend Laravel 5 Authentication to add authorization functionality.

## Installation

First, pull in the package through Composer.

```js
"require": {
    "ifaniqbal/sysguard": "dev-master"
}
```

Install with composer:

```bash
composer install
```

Include the service provider within `config/app.php`.

```php
'providers' => [
    'Ifaniqbal\Sysguard\SysguardServiceProvider'
];
```

Add a facade alias to this same file at the bottom:

```php
'aliases' => [
    'Sysguard' => 'Ifaniqbal\Sysguard\SysguardFacade'
];
```

Add this middleware within script `app/Http/Kernel.php`:

```php
protected $routeMiddleware = [
    'authorize' => 'Ifaniqbal\Sysguard\AuthorizeMiddleware'
];
```

Copy migration file to migration directory:

```bash
php artisan vendor:publish --force
```

Run artisan migrate to create the required tables on database:

```bash
php artisan migrate
```

This package use watson/boostrap-form. So, you need to add these service providers:

    'Collective\Html\HtmlServiceProvider',
    'Watson\BootstrapForm\BootstrapFormServiceProvider',

Then, add these aliases:

    'Form'      => 'Collective\Html\FormFacade',
    'HTML'      => 'Collective\Html\HtmlFacade',
    'BootstrapForm' => 'Watson\BootstrapForm\Facades\BootstrapForm',

## Usage

To check authorization for current user in current route:

```php
Sysguard::authorize();
```

To get sidebar menu for current user:

```php
Sysguard::getHierarchicalMenu();
```

To get all menu for current user:

```php
Sysguard::getEffectiveMenu();
```

To get all permission for current user:

```php
Sysguard::getEffectivePermission();
```
