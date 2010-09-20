<?php

namespace NS\Meta\Model\SetterStrategy;

use \NS\Meta\Model\SetterStrategy\AbstractStrategy;

class DefaultStrategy extends AbstractStrategy
{
	/**
	 * Main setter
	 *
	 * @return DefaultStrategy
	 */
	public function set()
	{
		return $this;
	}
}
