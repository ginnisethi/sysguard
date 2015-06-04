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

You may need to run `php artisan fresh` so that the migration doesn't conflict with Laravel user table migration.

Now, you're ready to add this route in `app/Http/routes.php`:

```php
Route::get ('/sysguard', ['uses' => '\Ifaniqbal\Sysguard\SysguardController@index', 'as' => 'sysguard.index']);

Route::resource('user', '\Ifaniqbal\Sysguard\UserController', ['except' => ['destroy']]);
Route::get ('/user/{user}/destroy', ['uses' => '\Ifaniqbal\Sysguard\UserController@destroy', 'as' => 'user.destroy']);

Route::resource('group', '\Ifaniqbal\Sysguard\GroupController', ['except' => ['destroy']]);
Route::get ('/group/{group}/destroy', ['uses' => '\Ifaniqbal\Sysguard\GroupController@destroy', 'as' => 'group.destroy']);

Route::resource('menu', '\Ifaniqbal\Sysguard\MenuController', ['except' => ['destroy']]);
Route::get ('/menu/{menu}/destroy', ['uses' => '\Ifaniqbal\Sysguard\MenuController@destroy', 'as' => 'menu.destroy']);

Route::resource('permission', '\Ifaniqbal\Sysguard\PermissionController', ['except' => ['destroy']]);
Route::get ('/permission/{permission}/destroy', ['uses' => '\Ifaniqbal\Sysguard\PermissionController@destroy', 'as' => 'permission.destroy']);
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

TODO: refactor interface
