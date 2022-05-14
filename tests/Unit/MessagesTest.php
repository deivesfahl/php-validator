<?php

use Validator\Validator;

function customizeMessagesByRule(
	string $fieldRule,
	string $fieldValue,
	string $fieldMessage,
	array $parameters = []
): array {
	$message = str_replace(':attribute', 'fieldName', $fieldMessage);

	$messageToBe = match ($fieldRule) {
		'between' => str_replace([':min', ':max'], [$parameters[0], $parameters[1]], $message),
		'max'     => str_replace(':max', $parameters[0], $message),
		'min'     => str_replace(':min', $parameters[0], $message),
		default   => $message,
	};

	$data = ['fieldName' => $fieldValue];

	$rule = match ($fieldRule) {
		'between' => ['fieldName' => "$fieldRule:" . implode(',', $parameters)],
		'max'     => ['fieldName' => "$fieldRule:" . implode(',', $parameters)],
		'min'     => ['fieldName' => "$fieldRule:" . implode(',', $parameters)],
		default   => ['fieldName' => $fieldRule],
	};

	return [$messageToBe, $data, $rule];
}

dataset('messageCustomizationRules', [
	['between', '16', 'The :attribute field must contain between :min and :max (Custom)', [16, 20]],
	['email', 'test@test', 'The :attribute field must be a valid email address (Custom)'],
	['max', 'Test', 'The :attribute field cannot contain more than :max character(s) (Custom)', [3]],
	['min', 'Test', 'The :attribute field must have at least :min character(s) (Custom)', [5]],
	['required', '', 'The :attribute field is mandatory (Custom)'],
]);

beforeEach(function () {
	$this->validator = new Validator();
});

test('Default message must be customized', function () {
	$this->validator->setDefaultMessages([
		'required' => 'The :attribute field is mandatory (Custom)',
	]);

	$data = ['name' => ''];
	$rule = ['name' => 'required'];

	$this->validator->validate($data, $rule);

	expect($this->validator->first('name'))->toBe('The name field is mandatory (Custom)');
});

test('Default message must be customized individually', function () {
	$this->validator->setDefaultMessage('required', 'The :attribute field is mandatory (Custom)');

	$data = ['name' => ''];
	$rule = ['name' => 'required'];

	$this->validator->validate($data, $rule);

	expect($this->validator->first('name'))->toBe('The name field is mandatory (Custom)');
});

test('Rule message must be customized', function (
	string $fieldRule,
	string $fieldValue,
	string $fieldMessage,
	array $parameters = []
) {
	[$message, $data, $rule] = customizeMessagesByRule(
		$fieldRule,
		$fieldValue,
		$fieldMessage,
		$parameters
	);

	$this->validator->setMessages([
		"fieldName.{$fieldRule}" => $fieldMessage,
	]);

	$this->validator->validate($data, $rule);

	expect($this->validator->first('fieldName'))->toBe($message);
})->with('messageCustomizationRules');

test('Rule message must be customized individually', function (
	string $fieldRule,
	string $fieldValue,
	string $fieldMessage,
	array $parameters = []
) {
	[$message, $data, $rule] = customizeMessagesByRule(
		$fieldRule,
		$fieldValue,
		$fieldMessage,
		$parameters
	);

	$this->validator->setMessage("fieldName.{$fieldRule}", $fieldMessage);

	$this->validator->validate($data, $rule);

	expect($this->validator->first('fieldName'))->toBe($message);
})->with('messageCustomizationRules');
