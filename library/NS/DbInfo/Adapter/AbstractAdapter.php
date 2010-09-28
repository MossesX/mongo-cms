<?php

namespace NS\DbInfo\Adapter;

use \NS\DbInfo\DSN;

class AbstractAdapter implements AdapterInterface
{
	/**
	 * Retrieves connection identifier
	 *
	 * @param DSN $dsn
	 * @return mixed
	 */
	public function connect(DSN $dsn)
	{
		return null;
	}

	/**
	 * Retrieves schemas list
	 *
	 * @return array
	 */
	public function getSchemas()
	{
		return array();
	}

	/**
	 * Retrieves tables list
	 *
	 * @return array
	 */
	public function getTables()
	{
		return array();
	}
}
