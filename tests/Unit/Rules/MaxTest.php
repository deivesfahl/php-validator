<?php

use Validator\Validator;

beforeEach(function () {
	$this->validator = new Validator();
});

test('Rule without max amount parameter must fail', function () {
	$data = ['name' => 'Test'];
	$rule = ['name' => 'max'];

	expect(fn () => $this->validator->validate($data, $rule))->toThrow(
		InvalidArgumentException::class,
		'Validator (max): The max number of characters was not informed'
	);
});

test('Field with quantity greater than the max allowed must fail', function () {
	$data = ['name' => 'Testt'];
	$rule = ['name' => 'max:4'];

	$this->validator->validate($data, $rule);

	expect($this->validator->fails())->toBeTrue();
});

test('Field with quantity less than or equal to allowed must not fail', function () {
	$data = ['name' => 'Test'];
	$rule = ['name' => 'max:4'];

	$this->validator->validate($data, $rule);

	expect($this->validator->fails())->toBeFalse();
});
