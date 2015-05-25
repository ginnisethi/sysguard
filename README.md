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

Now, you're ready to add this route in `app/Http/routes.php`. I know, this is huge routes. Someday, I'll change this implementation to REStful route.

```php
Route::get ('user/manage', '\Ifaniqbal\Sysguard\UserController@manage');
Route::get ('user/create', '\Ifaniqbal\Sysguard\UserController@create');
Route::post('user/create', array('before' => 'csrf', 'uses' => '\Ifaniqbal\Sysguard\UserController@create'));
Route::get ('user/detail', '\Ifaniqbal\Sysguard\UserController@detail');
Route::get ('user/update', '\Ifaniqbal\Sysguard\UserController@update');
Route::post('user/update', array('before' => 'csrf', 'uses' => '\Ifaniqbal\Sysguard\UserController@update'));
Route::get ('user/delete', '\Ifaniqbal\Sysguard\UserController@delete');
Route::get ('user/update/{id}', '\Ifaniqbal\Sysguard\UserController@update');
Route::post('user/update/{id}', array('before' => 'csrf', 'uses' => '\Ifaniqbal\Sysguard\UserController@update'));
Route::get ('user/delete/{id}', '\Ifaniqbal\Sysguard\UserController@delete');
Route::get ('user/change_password/{id}', '\Ifaniqbal\Sysguard\UserController@changePassword');
Route::post('user/change_password/{id}', array('before' => 'csrf', 'uses' => '\Ifaniqbal\Sysguard\UserController@changePassword'));

Route::get ('group', '\Ifaniqbal\Sysguard\GroupController@index');
Route::get ('group/manage', '\Ifaniqbal\Sysguard\GroupController@manage');
Route::get ('group/detail/{id}', '\Ifaniqbal\Sysguard\GroupController@detail');
Route::get ('group/create', '\Ifaniqbal\Sysguard\GroupController@create');
Route::post('group/create', array('before' => 'csrf', 'uses' => '\Ifaniqbal\Sysguard\GroupController@create'));
Route::get ('group/update/{id}', '\Ifaniqbal\Sysguard\GroupController@update');
Route::post('group/update/{id}', array('before' => 'csrf', 'uses' => '\Ifaniqbal\Sysguard\GroupController@update'));
Route::get ('group/delete/{id}', '\Ifaniqbal\Sysguard\GroupController@delete');

Route::get ('menu', '\Ifaniqbal\Sysguard\MenuController@index');
Route::get ('menu/manage', '\Ifaniqbal\Sysguard\MenuController@manage');
Route::get ('menu/detail/{id}', '\Ifaniqbal\Sysguard\MenuController@detail');
Route::get ('menu/create', '\Ifaniqbal\Sysguard\MenuController@create');
Route::post('menu/create', array('before' => 'csrf', 'uses' => '\Ifaniqbal\Sysguard\MenuController@create'));
Route::get ('menu/update/{id}', '\Ifaniqbal\Sysguard\MenuController@update');
Route::post('menu/update/{id}', array('before' => 'csrf', 'uses' => '\Ifaniqbal\Sysguard\MenuController@update'));
Route::get ('menu/delete/{id}', '\Ifaniqbal\Sysguard\MenuController@delete');

Route::get ('permission', '\Ifaniqbal\Sysguard\PermissionController@index');
Route::get ('permission/manage', '\Ifaniqbal\Sysguard\PermissionController@manage');
Route::get ('permission/detail/{id}', '\Ifaniqbal\Sysguard\PermissionController@detail');
Route::get ('permission/create', '\Ifaniqbal\Sysguard\PermissionController@create');
Route::post('permission/create', array('before' => 'csrf', 'uses' => '\Ifaniqbal\Sysguard\PermissionController@create'));
Route::get ('permission/update/{id}', '\Ifaniqbal\Sysguard\PermissionController@update');
Route::post('permission/update/{id}', array('before' => 'csrf', 'uses' => '\Ifaniqbal\Sysguard\PermissionController@update'));
Route::get ('permission/delete/{id}', '\Ifaniqbal\Sysguard\PermissionController@delete');
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
