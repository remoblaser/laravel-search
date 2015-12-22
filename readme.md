# Search Package for Laravel 5

## Install With Composer

```js
"require": {
    "remoblaser/search": "^0.3.0"
}
```

## Configure the app
Add the service provider to `config/app.php`.

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
php artisan vendor:publish
```

## Usage

After publishing the config, you will find a config file under `app/packages/remoblaser/search/config.php`, bind your Models to a key here, if you have a `Posts` table for example, add it here:

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

Or you could search all registered Tables for the Keyword.

```php
Search::all('bla')
```

Feel free to make pull requests, this is my first laravel package so im sure i did things badly
