<?php

namespace NS\Meta;

use \NS\Core\Cls\Fluent\Options;

abstract class Model extends Options
{
	/**
	 * Filling model properties from array
	 *
	 * @param array $array
	 * @return Model
	 */
	public abstract function fromArray(array $array);

	/**
	 * Converting model to array
	 *
	 * @return array
	 */
	public abstract function toArray();
}
