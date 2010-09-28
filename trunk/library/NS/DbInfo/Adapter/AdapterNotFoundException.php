<?php

namespace NS\DbInfo\Adapter;

use \NS\Dbinfo\Exception;

class AdapterNotFoundException extends Exception
{
	/**
	 * Constructor
	 *
	 * @param string $adapter
	 */
	public function __construct($adapter)
	{
		parent::__construct("Adapter '$adapter' doesn't exist");
	}
}
