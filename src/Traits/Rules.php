<?php

declare(strict_types=1);

namespace Validator\Traits;

/**
 * @author    Deives Fahl <dfahl.cps@gmail.com>
 * @copyright (c) 2022, Deives Fahl
 */
trait Rules
{
	private array $rules = [];

	/**
	 * Set rules.
	 *
	 * @access public
	 *
	 * @param array $rules
	 *
	 * @return void
	 */
	public function setRules(array $rules): void
	{
		$this->rules = array_merge($rules, $this->rules);
	}

	/**
	 * Set rule.
	 *
	 * @access public
	 *
	 * @param string $field
	 * @param string $rule
	 *
	 * @return self
	 */
	public function setRule(string $field, string $rule): self
	{
		$this->rules[$field] = $rule;

		return $this;
	}
}
