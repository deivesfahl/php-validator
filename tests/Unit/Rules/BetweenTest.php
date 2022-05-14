<?php

use Validator\Validator;

beforeEach(function () {
	$this->validator = new Validator();
});

test('Rule without min and max quantity parameters should fail', function () {
	$data = ['age' => 16];
	$rule = ['age' => 'between'];

	expect(fn () => $this->validator->validate($data, $rule))->toThrow(
		InvalidArgumentException::class,
		'Validator (between): The min and max quantity were not informed'
	);
});

test('Rule without min or max quantity parameter must fail', function (string $rule) {
	$data = ['age' => 16];
	$rule = ['age' => $rule];

	expect(fn () => $this->validator->validate($data, $rule))->toThrow(
		InvalidArgumentException::class,
		'Validator (between): The min or max quantity were not informed'
	);
})->with([
	'between:,',
	'between:16,',
	'between:,20',
]);

test('Field with value out of range must fail', function (int $age) {
	$data = ['age' => $age];
	$rule = ['age' => 'between:16,20'];

	$this->validator->validate($data, $rule);

	expect($this->validator->fails())->toBeTrue();
})->with([15, 16]);

test('Field with value within range must not fail', function (int $age) {
	$data = ['age' => $age];
	$rule = ['age' => 'between:16,20'];

	$this->validator->validate($data, $rule);

	expect($this->validator->fails())->toBeFalse();
})->with([17, 18, 19]);
