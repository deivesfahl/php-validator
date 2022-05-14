[English](README_EN.md)

# Validator

Biblioteca para validação de dados.

# Requisitos

-   PHP 8.0 ou superior

# Validações

-   Between
-   Email
-   Max
-   Min
-   Required

# Instalação

```bash
git clone https://github.com/deivesfahl/php-validator && cd php-validator

$ composer update
```

# Executando Testes

```bash
$ ./vendor/bin/pest
```

# Utilização

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

## Personalizar Atributos

```php
$validator->setAttribute('name', 'Name');

// Ou

$validator->setAttributes([
    'name' => 'Name'
]);
```

## Personalizar Conjuntos de Dados

```php
$validator->setDataset('name', $name);

// Ou

$validator->setDatasets([
    'name' => $name
]);
```

## Personalizar Mensagens

### Padrão

```php
$validator->setDefaultMessage('required', 'O campo :attribute é obrigatório');

// Ou

$validator->setDefaultMessages([
    'required' => 'O campo :attribute é obrigatório'
]);
```

### Por Campo/Regra

```php
$validator->setMessage('name.required', 'O campo :attribute é obrigatório');

// Ou

$validator->setMessages([
    'name.required' => 'O campo :attribute é obrigatório'
]);
```

## Personalizar Regras

```php
$validator->setRule('name', 'max:100');

// Ou

$validator->setRules([
    'name' => 'max:100'
]);
```
