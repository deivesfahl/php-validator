<?php

declare(strict_types=1);

namespace Validator\Validations\Rules;

use Validator\Validations\ValidationRule;

/**
 * @author    Deives Fahl <dfahl.cps@gmail.com>
 * @copyright (c) 2022, Deives Fahl
 */
final class Email extends ValidationRule
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
	public function handle(string $field, mixed $fieldValue, ...$parameters): bool
	{
		return filter_var($fieldValue, FILTER_VALIDATE_EMAIL) !== false;
	}
}
