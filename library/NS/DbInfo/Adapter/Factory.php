<?php

namespace NS\DbInfo\Adapter;

use \NS\DbInfo\DSN;

class Factory
{
	/**
	 * Creates adapter
	 *
	 * @param string $type
	 * @return AdapterInterface
	 */
	public static function createAdapter($type)
	{
		switch (strtolower($type))
		{
			case 'mysql':
				return new MySQL();
		}

		throw new AdapterNotFoundException($type);
	}
}
