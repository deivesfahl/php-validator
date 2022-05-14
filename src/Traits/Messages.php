<?php

declare(strict_types=1);

namespace Validator\Traits;

/**
 * @author    Deives Fahl <dfahl.cps@gmail.com>
 * @copyright (c) 2022, Deives Fahl
 */
trait Messages
{
	private array $messages = [];

	private array $defaultMessages = [
		'between'  => 'The :attribute field must contain between :min and :max',
		'email'    => 'The :attribute field must be a valid email address',
		'max'      => 'The :attribute field cannot contain more than :max character(s)',
		'min'      => 'The :attribute field must have at least :min character(s)',
		'required' => 'The :attribute field is mandatory',
	];

	/**
	 * Set messages.
	 *
	 * @access public
	 *
	 * @param array $messages
	 *
	 * @return void
	 */
	public function setMessages(array $messages): void
	{
		$this->messages = array_merge($messages, $this->messages);
	}

	/**
	 * Set message.
	 *
	 * @access public
	 *
	 * @param string $field
	 * @param string $message
	 *
	 * @return self
	 */
	public function setMessage(string $field, string $message): self
	{
		$this->messages[$field] = $message;

		return $this;
	}

	/**
	 * Set default messages.
	 *
	 * @access public
	 *
	 * @param array $messages
	 *
	 * @return void
	 */
	public function setDefaultMessages(array $messages): void
	{
		$this->defaultMessages = array_merge($this->defaultMessages, $messages);
	}

	/**
	 * Set default message.
	 *
	 * @access public
	 *
	 * @param string $rule
	 * @param string $message
	 *
	 * @return self
	 */
	public function setDefaultMessage(string $rule, string $message): self
	{
		$this->defaultMessages[$rule] = $message;

		return $this;
	}

	/**
	 * Custom message.
	 *
	 * @access protected
	 *
	 * @param string $field
	 * @param string $validation
	 *
	 * @return string|null
	 */
	protected function customMessage(string $field, string $validation): ?string
	{
		if (!isset($this->messages["{$field}.{$validation}"])) {
			return null;
		}

		return $this->messages["{$field}.{$validation}"];
	}

	/**
	 * Message without parameter.
	 *
	 * @access protected
	 *
	 * @param string $validation
	 * @param string $field
	 * @param string $message
	 *
	 * @return string
	 */
	protected function messageWithoutParameter(string $validation, string $field, string $message): string
	{
		$message = $this->customMessage($field, $validation) ?? $message;

		return isset($this->attributes[$field])
			? str_replace(':attribute', $this->attributes[$field], $message)
			: str_replace(':attribute', $field, $message);
	}

	/**
	 * Message with parameter.
	 *
	 * @access protected
	 *
	 * @param string $validation
	 * @param string $field
	 * @param string $message
	 * @param array  $replaces
	 *
	 * @return string
	 */
	protected function messageWithParameter(
		string $validation,
		string $field,
		string $message,
		array $replaces
	): string {
		$message = $this->customMessage($field, $validation) ?? $message;

		return str_replace(
			array_keys($replaces),
			array_values($replaces),
			$message
		);
	}
}
