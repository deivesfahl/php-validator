<?php

declare(strict_types=1);

namespace Validator\Traits;

use InvalidArgumentException;
use Validator\Validations\Rules\Between;
use Validator\Validations\Rules\Email;
use Validator\Validations\Rules\Max;
use Validator\Validations\Rules\Min;
use Validator\Validations\Rules\Required;

/**
 * @author    Deives Fahl <dfahl.cps@gmail.com>
 * @copyright (c) 2022, Deives Fahl
 */
trait Validations
{
	use Attributes;
	use Datasets;
	use Messages;

	private array $errors = [];

	/**
	 * Validate if the field has a value between min and max.
	 *
	 * @access public
	 *
	 * @param string $field
	 * @param mixed  $parameters
	 *
	 * @throws InvalidArgumentException
	 *
	 * @return void
	 */
	public function between(string $field, ...$parameters): void
	{
		$fieldValue = $this->fieldValue($field);

		if ($fieldValue === '') {
			return;
		}

		$params = $parameters[0] ?? null;

		if (!$params) {
			throw new InvalidArgumentException('Validator (between): The min and max quantity were not informed');
		}

		$params = explode(',', $params);
		$min    = isset($params[0]) ? (int) $params[0] : null;
		$max    = isset($params[1]) ? (int) $params[1] : null;

		if (!$min || !$max) {
			throw new InvalidArgumentException('Validator (between): The min or max quantity were not informed');
		}

		$betweenRule = new Between();
		$validation  = $betweenRule->handle($field, (int) $fieldValue, $min, $max);

		if (!$validation) {
			$message        = $this->defaultMessages['between'];
			$fieldAttribute = $this->attributes[$field] ?? $field;

			$this->errors[$field][] = $this->messageWithParameter('between', $field, $message, [
				':attribute' => $fieldAttribute,
				':min'       => $min,
				':max'       => $max,
			]);
		}
	}

	/**
	 * Validate if the field has a valid email.
	 *
	 * @access public
	 *
	 * @param string $field
	 *
	 * @return void
	 */
	public function email(string $field): void
	{
		$fieldValue = $this->fieldValue($field);

		if ($fieldValue === '') {
			return;
		}

		$emailRule  = new Email();
		$validation = $emailRule->handle($field, $fieldValue);

		if (!$validation) {
			$message = $this->defaultMessages['email'];

			$this->errors[$field][] = $this->messageWithoutParameter('email', $field, $message);
		}
	}

	/**
	 * Validate if the field has a value with the max number of characters.
	 *
	 * @access public
	 *
	 * @param string $field
	 * @param mixed  $parameters
	 *
	 * @throws InvalidArgumentException
	 *
	 * @return void
	 */
	public function max(string $field, ...$parameters): void
	{
		$fieldValue = $this->fieldValue($field);

		if ($fieldValue === '') {
			return;
		}

		$max = isset($parameters[0]) ? (int) $parameters[0] : null;

		if (!$max) {
			throw new InvalidArgumentException('Validator (max): The max number of characters was not informed');
		}

		$maxRule    = new Max();
		$validation = $maxRule->handle($field, $fieldValue, $max);

		if (!$validation) {
			$message        = $this->defaultMessages['max'];
			$fieldAttribute = $this->attributes[$field] ?? $field;

			$this->errors[$field][] = $this->messageWithParameter('max', $field, $message, [
				':attribute' => $fieldAttribute,
				':max'       => $max,
			]);
		}
	}

	/**
	 * Validate if the field has a value with the min number of characters.
	 *
	 * @access public
	 *
	 * @param string $field
	 * @param mixed  $parameters
	 *
	 * @throws InvalidArgumentException
	 *
	 * @return void
	 */
	public function min(string $field, ...$parameters): void
	{
		$fieldValue = $this->fieldValue($field);

		if ($fieldValue === '') {
			return;
		}

		$min = isset($parameters[0]) ? (int) $parameters[0] : null;

		if (!$min) {
			throw new InvalidArgumentException('Validator (min): The min number of characters was not informed');
		}

		$minRule    = new Min();
		$validation = $minRule->handle($field, $fieldValue, $min);

		if (!$validation) {
			$message        = $this->defaultMessages['min'];
			$fieldAttribute = $this->attributes[$field] ?? $field;

			$this->errors[$field][] = $this->messageWithParameter('min', $field, $message, [
				':attribute' => $fieldAttribute,
				':min'       => $min,
			]);
		}
	}

	/**
	 * Validate if the field has a value.
	 *
	 * @access public
	 *
	 * @param string $field
	 *
	 * @return void
	 */
	public function required(string $field): void
	{
		$requiredRule = new Required();
		$validation   = $requiredRule->handle($field, $this->fieldValue($field));

		if (!$validation) {
			$message = $this->defaultMessages['required'];

			$this->errors[$field][] = $this->messageWithoutParameter('required', $field, $message);
		}
	}

	/**
	 * Get field value.
	 *
	 * @access private
	 *
	 * @param string $field
	 *
	 * @return mixed
	 */
	private function fieldValue(string $field): mixed
	{
		return $this->datasets[$field] ?? '';
	}
}
