# Fluent-Facebook

[![License](https://poser.pugx.org/iluminar/fluent-facebook/license?format=flat-square)](https://packagist.org/packages/iluminar/fluent-facebook)
[![StyleCI](https://styleci.io/repos/65401645/shield?branch=master)](https://styleci.io/repos/65401645)
[![Twitter URL](https://img.shields.io/twitter/url/https/twitter.com/fold_left.svg?style=social&label=Follow%20%40hasnayeen)](https://twitter.com/nhasnayeen)

[Docs](https://iluminar.github.io/README.html)

A laravel 5 package for reading and writing to facebook graph object with ease in laravelish syntax. Check out how easy it is to read from facebook graph api.
``` php
$user = Auth::user();
$user = Fluent::user($user->fb_id)->get();
```
That's it. The $user object is a collection (`Illuminate\Support\Collection`) of facebook user data.

If you want extra information like about, first_name, education etc. just pass an array with the field name in `with` method.
``` php
$user = Auth::user();
$fields = ['hometown', 'first_name', 'about', 'birthday', 'cover', 'education'];
$user = Fluent::user($user->fb_id)->with($fields)->get();
```

If you want to get the feed of the user just chain the feed method to the user object. 
``` php
$user = Auth::user();
$feed = Fluent::user($user->fb_id)->feed()->get();
```


If you want to get information of a post just pass the post id to the `post` method. 
``` php
$user = Auth::user();
$posts = Fluent::post($post_id)->get();
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

### Get different node information
Facebook information is represented as a social graph which composed of following three things:
> `nodes` - basically "things" such as a User, a Photo, a Page, a Comment

> `edges` - the connections between those "things", such as a Page's Photos, or a Photo's Comments

> `fields` - info about those "things", such as a person's birthday, or the name of a Page

First you need to instantiate a Fluent instance.
``` php
$fluent = new Fluent();
```
Or if you use `fluent` facade then you dont need a `fluent` instance.

Now if you want information about a user or photo, just call a method by that name on `fluent` object, pass the id of that node i.e id of the user or photo and chained that with `get` method which will return a collection about that node.
``` php
$user = Fluent::user($id)->get();
```
N.B: The facebook id of the user is saved in fb_id column of the `users` table.

When you retrieving a node information you can also specify the fields for that node to get extra information. For that just pass an array of fields name to the `with` method chained to that node call.
``` php
$fields = ['link', 'name', 'album'];
$photo = Fluent::photo($id)->with($fields)->get();
```

To get information of an node's edge (e.g photo's comments) just chain a method by the edge name to the node call.
``` php
$photo = Fluent::photo($id)->comments()->get();
```

## Documentation

[Docs](https://iluminar.github.io/README.html)

### TODO

> **publish option**

> **Error handling**

## Security Vulnerabilities

If you discover a security vulnerability in the package, please send an e-mail to Nehal Hasnayeen at searching.nehal@gmail.com. All security vulnerabilities will be promptly addressed.

## License

The **Fluent-facebook** is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributor

Made by [Hasnayeen](https://github.com/hasnayeen) with love in ![Bangladesh](https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Flag_of_Bangladesh.svg/20px-Flag_of_Bangladesh.svg.png)
