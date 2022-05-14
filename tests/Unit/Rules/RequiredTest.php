<?php

use Validator\Validator;

beforeEach(function () {
	$this->validator = new Validator();
});

test('Field without value should fail', function () {
	$data = ['name' => ''];
	$rule = ['name' => 'required'];

	$this->validator->validate($data, $rule);

	expect($this->validator->fails())->toBeTrue();
});

test('Field with value must not fail', function () {
	$data = ['name' => 'Test'];
	$rule = ['name' => 'required'];

	$this->validator->validate($data, $rule);

	expect($this->validator->fails())->toBeFalse();
});
