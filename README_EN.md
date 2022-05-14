# Validator

Library for data validation.

# Requirements

-   PHP 8.0 or higher

# Validations

-   Between
-   Email
-   Max
-   Min
-   Required

# Installation

```bash
git clone https://github.com/deivesfahl/php-validator && cd php-validator

$ composer update
```

# Running Tests

```bash
$ ./vendor/bin/pest
```

# Use

```php
require __DIR__ . '/vendor/autoload.php';

use Validator\Validator;

$validator = new Validator();

$data = [
    'name' => ''
];

$validator->validate($data, [
    'name' => 'required|min:2'
]);

if ($validator->fails()) {
    var_dump($validator->errors());
}
```

## Attributes

```php
$validator->setAttribute('name', 'Name');

// Ou

$validator->setAttributes([
    'name' => 'Name'
]);
```

## Dataset

```php
$validator->setDataset('name', $name);

// Ou

$validator->setDatasets([
    'name' => $name
]);
```

## Messages

### Standard

```php
$validator->setDefaultMessage('required', 'O campo :attribute é obrigatório');

// Ou

$validator->setDefaultMessages([
    'required' => 'O campo :attribute é obrigatório'
]);
```

### By Field/Rule

```php
$validator->setMessage('name.required', 'O campo :attribute é obrigatório');

// Ou

$validator->setMessages([
    'name.required' => 'O campo :attribute é obrigatório'
]);
```

## Rules

```php
$validator->setRule('name', 'max:100');

// Ou

$validator->setRules([
    'name' => 'max:100'
]);
```
