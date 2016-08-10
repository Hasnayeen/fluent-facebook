# Fluent-Facebook

A laravel 5 package for reading and writing to facebook graph object with ease in laravelish syntax. Check out how easy it is to read to facebook graph api.

``` php
$user = Auth::user();
$fluent = new Fluent($user);
$user = $fluent->user($user->fb_id)->get();
```

That's it. The $user object is a `Illuminate\Support\Collection` object of facebook user data. If you want extra information like about, first_name, education etc. just pass an array with the field name in `with` method.
``` php
$user = Auth::user();
$fluent = new Fluent($user);
$fields = ['hometown', 'first_name', 'about', 'birthday', 'cover', 'education'];
$user = $fluent->user($user->fb_id)->with($fields)->get();
```

If you want to get the feed of the user just chain the feed method to the user object. 
``` php
$user = Auth::user();
$fluent = new Fluent($user);
$feed = $fluent->user($user->fb_id)->feed()->get();
```


If you want to get information of a post just pass the post id to the `post` method. 
``` php
$user = Auth::user();
$fluent = new Fluent($user);
$posts = $fluent->post($post_id)->get();
```

## Install

You can pull in the package via composer:
``` bash
$ composer require iluminar/fluent-facebook
```

Or you can add this in your composer.json

``` bash
"require": {
    "iluminar/fluent-facebook": "dev-develop"
}
```

and then terminal from your root directory of project run following command
``` bash
$ composer update
```

After updating composer, add a fluent service provider to the providers array in config/app.php file.

``` php
 'providers' => array(
        // ...
        Iluminar\Fluent\Providers\FluentServiceProvider::class,
    )
```

then run in terminal
``` bash
$ php artisan vendor:publish
```

to add package tables in your database run following command
``` bash
$ php artisan migrate
```

## Configuration

First you have to [create a facebook app](https://developers.facebook.com/apps/) and set the `app_id`, `app_secret` and `redirect_uri` in the configuration file.
``` php
'facebook' => [
    'client_id' => env('FB_APP_ID'),
    'client_secret' => env('FB_APP_SECRET'),
    'redirect_uri' => env('FB_REDIRECT_URI'),
],
```

To define what permissions your app need you can set those permission under `scopes` key. Just change the value of particular permission scope to `true`. By default `email` permission is set to true. Remember, for extra permission you have to submit your app for review by facebook.
``` php
'scope' => [
    "public_profile" => false,
    "user_friends" => false,
    "email" => true,
    "user_about_me" => false,
]
```

For user authentication `fluent` use laravel's default users table and user model. But if you use different table and model then set those on config file.
``` php
'user_model' => 'user',
'user_table_name' => 'users',
'user_model_namespace' => 'App',

```

## Usage

### Logging The User Into Laravel

All the routes and authentication logic for authentication via facebook is provided by package. Just add `redirect` route to your login button, it will redirect the user to facebook login dialog box.

## Documentation

Yet to be added.

### TODO

> **documentation**

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Nehal Hasnayeen at searching.nehal@gmail.com. All security vulnerabilities will be promptly addressed.

## License

The **Fluent-facebook** is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.
