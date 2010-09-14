<?php

namespace NS\Core;

class Exception extends \Exception
{
	/**
	 * Constructor
	 *
	 * @param string $message
	 */
	public function __construct($message)
	{
		parent::__construct($message);
	}
}
