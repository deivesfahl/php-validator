<?php

use Validator\Validator;

beforeEach(function () {
	$this->validator = new Validator();
});

test('Rule must be entered', function () {
	$data = ['name' => ''];

	$this->validator->setRules([
		'name' => 'required',
	]);

	$this->validator->validate($data, []);

	expect($this->validator->first('name'))->toBe('The name field is mandatory');
});

test('Rule must be entered individually', function () {
	$data = ['name' => ''];

	$this->validator->setRule('name', 'required');

	$this->validator->validate($data, []);

	expect($this->validator->first('name'))->toBe('The name field is mandatory');
});
