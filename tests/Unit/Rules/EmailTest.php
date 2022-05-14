<?php

use Validator\Validator;

beforeEach(function () {
	$this->validator = new Validator();
});

test('Field with invalid email address should fail', function () {
	$data = ['email' => 'test@test'];
	$rule = ['email' => 'email'];

	$this->validator->validate($data, $rule);

	expect($this->validator->fails())->toBeTrue();
});

test('Field with valid email address must not fail', function () {
	$data = ['email' => 'test@test.com'];
	$rule = ['email' => 'email'];

	$this->validator->validate($data, $rule);

	expect($this->validator->fails())->toBeFalse();
});
