<?php

use Validator\Validator;

beforeEach(function () {
	$this->validator = new Validator();
});

test('Information must be entered', function () {
	$rule = ['name' => 'min:5'];

	$this->validator->setDatasets([
		'name' => 'Test',
	]);

	$this->validator->validate([], $rule);

	expect($this->validator->first('name'))->toBe('The name field must have at least 5 character(s)');
});

test('Information must be entered individually', function () {
	$rule = ['name' => 'min:5'];

	$this->validator->setDataset('name', 'Test');

	$this->validator->validate([], $rule);

	expect($this->validator->first('name'))->toBe('The name field must have at least 5 character(s)');
});
