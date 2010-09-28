<?php

namespace NS\DbInfo;

use \NS\DbInfo\Adapter\Factory;

class Service
{
	/**
	 * Connection
	 * @var mixed
	 */
	private $_connection;

	/**
	 * Adapter
	 * @var AdapterInterface
	 */
	private $_adapter;

	/**
	 * Constructor
	 *
	 * @param string|DSN $dsn
	 */
	public function __construct($dsn)
	{
		$dsn = new DSN($dsn);
		$this->_adapter = Factory::createAdapter($dsn->getType());
		$this->_connection = $this->_adapter->connect($dsn);
	}

	/**
	 * Retrieves schemas list
	 *
	 * @return array
	 */
	public function getSchemas()
	{
		return $this->_adapter->getSchemas();
	}

	/**
	 * Retrieves tables list
	 *
	 * @param string $schema
	 * @return array
	 */
	public function getTables($schema)
	{
		return $this->_adapter->getTables($schema);
	}
}
