<?php

declare(strict_types=1);

namespace Validator\Traits;

/**
 * @author    Deives Fahl <dfahl.cps@gmail.com>
 * @copyright (c) 2022, Deives Fahl
 */
trait Attributes
{
	private array $attributes = [];

	/**
	 * Set attributes.
	 *
	 * @access public
	 *
	 * @param array $attributes
	 *
	 * @return void
	 */
	public function setAttributes(array $attributes): void
	{
		$this->attributes = array_merge($attributes, $this->attributes);
	}

	/**
	 * Set attribute.
	 *
	 * @access public
	 *
	 * @param string $field
	 * @param string $attribute
	 *
	 * @return self
	 */
	public function setAttribute(string $field, string $attribute): self
	{
		$this->attributes[$field] = $attribute;

		return $this;
	}
}
