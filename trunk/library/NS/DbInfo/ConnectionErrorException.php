<?php

namespace NS\DbInfo;

class ConnectionErrorException extends Exception
{
	/**
	 * Constructor
	 *
	 * @param string $error
	 */
	public function __construct($error)
	{
		parent::__construct("Connection error: $error");
	}
}
