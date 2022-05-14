[Português](README.md)

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

## Customize Attributes

```php
$validator->setAttribute('name', 'Name');

// Ou

$validator->setAttributes([
    'name' => 'Name'
]);
```

## Customize Datasets

```php
$validator->setDataset('name', $name);

// Ou

$validator->setDatasets([
    'name' => $name
]);
```

## Customize Messages

### Standard

```php
$validator->setDefaultMessage('required', 'The :attribute field is mandatory');

// Ou

$validator->setDefaultMessages([
    'required' => 'The :attribute field is mandatory'
]);
```

### By Field/Rule

```php
$validator->setMessage('name.required', 'The :attribute field is mandatory');

// Ou

$validator->setMessages([
    'name.required' => 'The :attribute field is mandatory'
]);
```

## Customize Rules

```php
$validator->setRule('name', 'max:100');

// Ou

$validator->setRules([
    'name' => 'max:100'
]);
```

# Methods

## validate

Run the validation based on the data and rules entered.

```php
$validator->validate($datasets, $rules);
```

## fails

Checks if validation returned errors.

```php
$validator->fails();
```

## errors

Get all errors.

```php
$validator->errors();
```

Get errors from a specific field.

```php
$validator->errors('name');
```

## first

Get only first error of a field.

```php
$validator->first('name');
```

## firstOfAll

Get only first error of the fields.

```php
$validator->firstOfAll('name');
```
