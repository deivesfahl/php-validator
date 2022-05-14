<?php

use Validator\Validator;

beforeEach(function () {
	$this->validator = new Validator();
});

test('Attribute must be customized', function () {
	$this->validator->setAttributes([
		'name' => 'Your Name',
	]);

	$data = ['name' => ''];
	$rule = ['name' => 'required'];

	$this->validator->validate($data, $rule);

	expect($this->validator->first('name'))->toBe('The Your Name field is mandatory');
});

test('Attribute must be customized individually', function () {
	$this->validator->setAttribute('name', 'Your Name');

	$data = ['name' => ''];
	$rule = ['name' => 'required'];

	$this->validator->validate($data, $rule);

	expect($this->validator->first('name'))->toBe('The Your Name field is mandatory');
});
