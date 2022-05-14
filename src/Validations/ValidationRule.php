<?php

declare(strict_types=1);

namespace Validator\Validations;

/**
 * @author    Deives Fahl <dfahl.cps@gmail.com>
 * @copyright (c) 2022, Deives Fahl
 */
abstract class ValidationRule
{
	/**
	 * Handle validation.
	 *
	 * @access public
	 *
	 * @param string $field
	 * @param mixed  $fieldValue
	 * @param mixed  $parameters
	 *
	 * @return boolean
	 */
	abstract public function handle(string $field, mixed $fieldValue, ...$parameters): bool;
}
