
# Diskominfotik Password Sakti Helper for Laravel

## Installation
Before doing the composer require, please add a VCS Repository
```json
// composer.json
...
"repositories": [
	{
		"type": "vcs",
		"url": "https://git.jakarta.go.id/abuabbas/pwdskt",
		"packagist.org": false
	}
]
...
```
Then you can install the package via composer:
```bash

composer require diskominfotik/pwdskt

```

## Usage
``` php
// publish configuration
php  artisan  pwdskt:publish


// generate token
php  artisan  pwdskt:generate <your_password>
```

Change `eloquent` provider with `pwdskt` provider
```php
// config/auth.php
...
'providers' => [
	'users' => [
		'driver' => 'pwdskt',
		...
	],
],
...
```

```php
// app/Providers/AuthServiceProvider.php
public  function  boot()
{
	...
	\Illuminate\Support\Facades\Auth::provider('pwdskt', function ($app, array  $config) {
		return  new  \Diskominfotik\Pwdskt\PwdsktProvider($app['hash'], $config['model']);
	});
	...
}
```
