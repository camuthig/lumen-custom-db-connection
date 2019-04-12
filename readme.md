# Custom Database Connection Factory

This application is a sample of how one might create a custom database connection
strategy in Lumen, even require external resource such as Redis to get the connection
configuration.

## Setup

```bash
composer install
docker-compose up -d
# Populate redis with test configuration values
php artisan configuration:seed
```

## Running

```bash
composer run
```

## Testing

Going to `http://localhost:8000/database` route runs a simple query against the database and
returns 'Works!' on success or prints the error otherwise.

## Parts

### Credentials Service

[A sample service](app/Services/Credentials.php) that stores secure credentials. In the case of this application the store
is not actually secure - it is just accessing Redis. The same idea could be extended to
whatever service might store credentials the application may need though.

### Distributed Configuration

[A class](app/Services/DistributedConfiguration.php) that allows accessing configuration stored in a central repository rather than
directly on our server. In this case, Redis is also being used as our central configuration
store.

### CustomConnectionFactory

An extension of the standard Laravel `ConnectionFactory` that is injected with the `Credentials`
and `DistributedConfiguration` services. The `parseConfig` function is overridden to pull the
configuration values from the two services and return back the new array for the config. All other
logic is capable of reusing the code already written in the framework's library.

### DatabaseConnectionServiceProvider

A basic service provider with just a `boot` function that extends the `DatabaseManager` to use the
`CustomConnectionFactory` to make the connection instead of the standard `ConnectionFactory` when
the `custom` name is provided.


## Configuration

While the configuration values in the `database.php` are not actually used for connecting to the
database, you still must have a `custom` key in your `database.connections` config array, otherwise
Laravel will throw an error.
