<?php

declare(strict_types=1);

namespace Validator;

use InvalidArgumentException;
use Validator\Traits\Datasets;
use Validator\Traits\Rules;
use Validator\Traits\Validations;

/**
 * @author    Deives Fahl <dfahl.cps@gmail.com>
 * @copyright (c) 2022, Deives Fahl
 */
final class Validator
{
	use Datasets;
	use Rules;
	use Validations;

	private array $data = [];

	/**
	 * Validate.
	 *
	 * @access public
	 *
	 * @param array $datasets
	 * @param array $rules
	 *
	 * @return void
	 */
	public function validate(array $datasets, array $rules): void
	{
		$this->setDatasets($datasets);
		$this->setRules($rules);

		foreach ($this->rules as $field => $rule) {
			$this->validation($field, $rule);
		}
	}

	/**
	 * Check for errors.
	 *
	 * @access public
	 *
	 * @return boolean
	 */
	public function fails(): bool
	{
		return !empty($this->errors);
	}

	/**
	 * Get errors.
	 *
	 * @access public
	 *
	 * @param string|null $field
	 *
	 * @return array
	 */
	public function errors(?string $field = null): array
	{
		return !$field ? $this->errors : $this->errors[$field] ?? [];
	}

	/**
	 * Get first error.
	 *
	 * @access public
	 *
	 * @return string
	 */
	public function first(string $field): string
	{
		return $this->errors[$field][0] ?? '';
	}

	/**
	 * Get first error of each field.
	 *
	 * @access public
	 *
	 * @return array
	 */
	public function firstOfAll(): array
	{
		$errors     = [];
		$errorsKeys = array_keys($this->errors);

		foreach ($errorsKeys as $field) {
			$errors[$field] = $this->errors[$field][0];
		}

		return $errors;
	}

	/**
	 * Validate rules.
	 *
	 * @access private
	 *
	 * @param string $field
	 * @param string $rule
	 *
	 * @return void
	 */
	private function validation(string $field, string $rule): void
	{
		$validations = explode('|', $rule);

		foreach ($validations as $validation) {
			$this->validationWithoutParameter($field, $validation);
			$this->validationWithParameter($field, $validation);
		}
	}

	/**
	 * Checks if validation method exists.
	 *
	 * @access private
	 *
	 * @param string $validationMethod
	 *
	 * @throws InvalidArgumentException
	 *
	 * @return void
	 */
	private function validationMethodExists(string $validationMethod): void
	{
		if (method_exists($this, $validationMethod)) {
			return;
		}

		throw new InvalidArgumentException("Validation method \"{$validationMethod}\" not found");
	}

	/**
	 * Validate rules without parameters.
	 *
	 * @access private
	 *
	 * @param string $field
	 * @param string $validation
	 *
	 * @return void
	 */
	private function validationWithoutParameter(string $field, string $validation): void
	{
		if (str_contains($validation, ':')) {
			return;
		}

		$this->validationMethodExists($validation);

		$this->$validation($field);
	}

	/**
	 * Validate rules with parameters.
	 *
	 * @access private
	 *
	 * @param string $field
	 * @param string $validation
	 *
	 * @return void
	 */
	private function validationWithParameter(string $field, string $validation): void
	{
		if (!str_contains($validation, ':')) {
			return;
		}

		[$validationWithParameter, $parameter] = explode(':', $validation);

		$this->validationMethodExists($validationWithParameter);

		$this->$validationWithParameter($field, $parameter);
	}
}
