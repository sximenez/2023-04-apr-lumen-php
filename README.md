# Lumen PHP

[Source: Autho](https://auth0.com/blog/developing-restful-apis-with-lumen/)
[Source: Laravel](https://laravel.com/docs/10.x/facades)

Lumen is a lightweight backend alternative to Laravel.

It is used to build microservices and APIs, and it can be upgraded to Laravel when scaling up.

Microservices are like components for the backend.

Instead of building a _monolithic_ application where every function is contained within a single codebase, we can decompose the app into several, independent component or services.

This helps with organization, simplicity and maintenance.

## Eloquent ORM

An ORM (Object Relational Mapping) brings together relational databases and object-oriented concepts.

For example, we can define classes that represent tables.

In the bootstrap > app.php file, uncomment `$app->withEloquent();` and `$app->withFacades();`.

Eloquent will enable us to use classes that represent tables.

And Facades are Lavarel methods.

## .env

Connect to the database via the .env configuration file.

## php artisan

php artisan is a Laravel CLI (commands) that simplify things in Lumen.

For example, `php artisan make:migration filename` creates a pre-configured migration file we can use to create or update a table in the database.

## Model

To add more php artisan commands like make:model, we can use a Lumen generator like Flipbox:

```Terminal
composer require flipbox/lumen-generator
```

```PHP
$app->register(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);
```

If we now run `php artisan make:model test`, we can create a new model boilerplate in the Models folder.

Attributes can be [mass assignable](https://laravel.com/docs/5.5/eloquent#mass-assignment) with `$fillable` or protected with `$guarded`.

## Routes

To use the Lumen router, you specify the request method as a method, and the controller it will action:

```PHP
$router->group(["prefix" => "api"], function () use ($router) {

    $router->get("authors", ["uses" => 'AuthorController@showAllAuthors']);

    $router->get('authors/{id}', ['uses' => 'AuthorController@showOneAuthor']);

    $router->post('authors', ['uses' => 'AuthorController@create']);

    $router->delete('authors/{id}', ['uses' => 'AuthorController@delete']);

    $router->put('authors/{id}', ['uses' => 'AuthorController@update']);
});
```

Grouping routes is very useful to apply functions to all routes, like middleware (authentication).

## Controllers

The router points to a controllers which points to a model.

We then specify the http actions being specified at the router level: `get, post, put and delete`.

## Testing

We can test the routes using an app like Insomnia.

## API validation

Currently, if we post empty data, it will be written on the database.

To set required fields, we can use the `$this->validate()` method in the controller:

```PHP
public function create(Request $request): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:authors',
            'location' => 'required|alpha'
        ]);

        $author = Author::create($request->all());

        return response()->json($author, 201);
    }
```

## Authentification
