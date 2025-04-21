# Apollo.io PHP Client

[![Packagist Version](https://img.shields.io/packagist/v/your-vendor/apollo-php.svg)](https://packagist.org/packages/your-vendor/apollo-php)
[![Build Status](https://img.shields.io/github/actions/workflow/status/your-vendor/apollo-php/phpunit.yml?branch=main)](https://github.com/your-vendor/apollo-php/actions)
[![License](https://img.shields.io/packagist/l/your-vendor/apollo-php.svg)](LICENSE)

A framework‑agnostic, PSR‑compliant PHP SDK for the [Apollo.io REST API](https://docs.apollo.io/docs/api-overview).  
Drop it into any modern PHP project (Laravel, Slim, Symfony, or plain PHP) and start searching people & companies in minutes.

---

## 📦 Installation

Install via Composer:

```bash
composer require your-vendor/apollo-php
```

Minimum PHP version: **8.1**.

This library depends on:

- **PSR‑18** HTTP Client (e.g. `guzzlehttp/guzzle`)
- **PSR‑17** HTTP Factories (e.g. `nyholm/psr7`)
- **PSR‑3** Logger (optional)

---

## 🔧 Configuration

Instantiate the client by providing your Apollo API key:

```php
use ApolloIo\Config\Settings;
use ApolloIo\Http\GuzzleClient;
use ApolloIo\ApolloClient;
use Nyholm\Psr7\Factory\Psr17Factory;

// 1. Settings (API key + optional base URI)
$settings = new Settings(getenv('APOLLO_API_KEY'));

// 2. PSR‑17 factories
$psr17    = new Psr17Factory();

// 3. PSR‑18 HTTP client (Guzzle implementation)
$guzzle   = new \GuzzleHttp\Client([
    'base_uri' => $settings->baseUri(),
    'headers'  => [
        'Authorization' => 'Bearer ' . $settings->apiKey(),
        'Accept'        => 'application/json',
    ],
]);
$http     = new GuzzleClient($guzzle);

// 4. Apollo client
$apollo   = new ApolloClient($settings, $http, $psr17, $psr17);
```

---

## 🚀 Usage

### Search People

```php
$results = $apollo
    ->people()
    ->search([
        'q'        => 'Jane Doe',
        'per_page' => 5,
    ]);

foreach ($results as $person) {
    echo "{$person['name']} — {$person['title']} at {$person['company_name']}\n";
}
```

### Search Companies

```php
$companies = $apollo
    ->companies()
    ->search([
        'name'     => 'Acme Corp',
        'per_page' => 3,
    ]);

foreach ($companies as $company) {
    echo "{$company['name']} ({$company['domain']}) — {$company['employee_count']} employees\n";
}
```

### Fetch by ID

```php
$person = $apollo->people()->get('abcd1234');
$company = $apollo->companies()->get('xyz7890');

print_r($person);
print_r($company);
```

---

## 🛠️ Laravel Integration

1. **Publish** a config file at `config/apollo.php`:
   ```php
   return [
       'api_key'  => env('APOLLO_API_KEY'),
       'base_uri' => env('APOLLO_BASE_URI', 'https://api.apollo.io/v1/'),
   ];
   ```
2. **Bind** in a Service Provider:
   ```php
   $this->app->singleton(\ApolloIo\ApolloClient::class, function ($app) {
       $cfg = $app['config']['apollo'];
       $settings = new \ApolloIo\Config\Settings($cfg['api_key'], $cfg['base_uri']);
       $psr17    = new \Nyholm\Psr7\Factory\Psr17Factory();
       $http     = new \ApolloIo\Http\GuzzleClient(
           new \GuzzleHttp\Client([
               'base_uri' => $settings->baseUri(),
               'headers'  => ['Authorization' => 'Bearer ' . $settings->apiKey()],
           ])
       );
       return new \ApolloIo\ApolloClient($settings, $http, $psr17, $psr17);
   });
   ```
3. **Use** anywhere via dependency injection or the container:
   ```php
   public function index(\ApolloIo\ApolloClient $apollo)
   {
       $people = $apollo->people()->search(['q'=>'CEO']);
       return view('people.index', compact('people'));
   }
   ```

---

## 🧪 Testing

This package includes **PHPUnit** tests:

```bash
composer install --dev
vendor/bin/phpunit
```

- Tests mock the PSR‑18 client to simulate API responses.
- Ensure coverage for success, error handling, and edge cases.

---

## 💡 Contributing

1. Fork the repo  
2. Create your feature branch: `git checkout -b feature/foo`  
3. Write tests and code  
4. Ensure coding style with PHP-CS-Fixer:  
   ```bash
   vendor/bin/php-cs-fixer fix --config=.php_cs.dist
   ```  
5. Submit a pull request

Please follow the [PSR‑12 coding standard](https://www.php-fig.org/psr/psr-12/) and write tests for new functionality.

---

## 📄 License

MIT © [Tommy O'Neill]

---

> Built with ❤️ for the PHP community. Happy coding!  
```