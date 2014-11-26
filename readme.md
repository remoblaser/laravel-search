# Search Package for Laravel 4.2

## Install With Composer

```js
"require": {
    "remoblaser/search": "dev-master"
}
```

## Configure the app
Add the service provider to `app/config/app.php`.

```php
'providers' => array(
		...
        'Remoblaser\Search\SearchServiceProvider',
	),
```

Register the alias in the `app/config/app.php` file.

```php
'aliases' => array(
    ...
    'Search' => 'Remoblaser\Search\Facades\Search'
	),
```

Publish the configuration
```
php artisan config:publish remoblaser/search
```

## Usage

After publishing the config, you will find a config file under `c`, bind your Models to a key here, if you have a `Posts` table for example, add it here:

```php
return array(
    'users' => 'User',
    'posts' => 'My\Sample\Namespace\Post'
);
```

Afterwards you have to implement the SearchableTrait in your Model and define the Fields which you would like to search. In this example i would like to search through the titles and the bodies.

```php
<?php namespace My\Sample\Namespace;

use Remoblaser\Search\SearchableTrait;

class Post extends \Eloquent{
    use SearchableTrait;

    protected $searchFields = ['title', 'body'];
}
```

Now you can Search through your Tables from anywhere in your application by using the Search Facade, followed by the binding key.

```php
Search::posts('bla')
```