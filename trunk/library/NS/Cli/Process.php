<?php

namespace NS\Cli;

use \NS\Core\Cls\Fluent;

class Process extends Fluent
{
	/**
	 * Options
	 * @var array
	 */
	protected $_options = array();

	public function addOption(Option $option)
	{
		$this->_options[] = $option;
		return $this;
	}

	public function getOptions()
	{
		return $this->_options;
	}

	public function getOption($name)
	{
		foreach ($this->_options as &$option)
			if ($option->getName() == $name)
				return $option;
		return null;
	}

	/**
	 * Retrieves arguments
	 * 
	 * @return array
	 */
	public function getArguments()
	{
		$args = array(); $key = '';
		foreach ($_SERVER['argv'] as $arg) {
			if ($arg[0] == '-')
				$key = substr($arg, 1);
			else if ($key) {
				$args[$key] = $arg;
				$key = '';
			}
		}
		return $args;
	}

	/**
	 * Stops with error
	 *
	 * @param string $message
	 */
	public function stop($message)
	{
		die("\n\nError: $message \n\n");
	}

	public function ln()
	{
		echo "\n";
		return $this;
	}

	public function write($message)
	{
		echo $message;
		return $this;
	}
}
