<?php

declare(strict_types=1);

namespace Validator\Traits;

/**
 * @author    Deives Fahl <dfahl.cps@gmail.com>
 * @copyright (c) 2022, Deives Fahl
 */
trait Datasets
{
	private array $datasets = [];

	/**
	 * Set datasets.
	 *
	 * @access public
	 *
	 * @param array $datasets
	 *
	 * @return void
	 */
	public function setDatasets(array $datasets): void
	{
		$this->datasets = array_merge($datasets, $this->datasets);
	}

	/**
	 * Set dataset.
	 *
	 * @access public
	 *
	 * @param string $field
	 * @param string $dataset
	 *
	 * @return self
	 */
	public function setDataset(string $field, string $dataset): self
	{
		$this->datasets[$field] = $dataset;

		return $this;
	}
}
