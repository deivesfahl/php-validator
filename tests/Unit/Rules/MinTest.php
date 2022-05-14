<?php

use Validator\Validator;

beforeEach(function () {
	$this->validator = new Validator();
});

test('Rule without minimum quantity parameter must fail', function () {
	$data = ['name' => 'Test'];
	$rule = ['name' => 'min'];

	expect(fn () => $this->validator->validate($data, $rule))->toThrow(
		InvalidArgumentException::class,
		'Validator (min): The min number of characters was not informed'
	);
});

test('Field with quantity less than the minimum allowed must fail', function () {
	$data = ['name' => 'Tes'];
	$rule = ['name' => 'min:4'];

	$this->validator->validate($data, $rule);

	expect($this->validator->fails())->toBeTrue();
});

test('Field with quantity greater than or equal to the minimum allowed must not fail', function () {
	$data = ['name' => 'Test'];
	$rule = ['name' => 'min:4'];

	$this->validator->validate($data, $rule);

	expect($this->validator->fails())->toBeFalse();
});
