<?php

namespace NS\DbInfo\Adapter;

use \NS\DbInfo\ConnectionErrorException;
use \NS\DbInfo\DSN;

class MySQL extends AbstractAdapter
{
	/**
	 * Retrieves connection identifier
	 *
	 * @param DSN $dsn
	 * @return mixed
	 */
	public function connect(DSN $dsn)
	{
		$connection = mysql_connect(
			$dsn->getHost(),
			$dsn->getUserName(),
			$dsn->getPassword()
		);

		if (!$connection)
			throw new ConnectionErrorException(mysql_error());

		return $connection;
	}

	/**
	 * Retrieves schemes list
	 *
	 * @return array
	 */
	public function getSchemas()
	{
		$result = mysql_query('SELECT `SCHEMA_NAME` FROM `information_schema`.`SCHEMATA` ORDER BY `SCHEMA_NAME`');
		$schemas = array();
		while ($schema = mysql_fetch_row($result))
			$schemas[] = $schema[0];
		return $schemas;
	}

	/**
	 * Retrieves tables list
	 *
	 * @param string $schema
	 * @return array
	 */
	public function getTables($schema)
	{
		$result = mysql_query('SELECT `TABLE_NAME` FROM `information_schema`.`TABLES` WHERE `TABLE_SCHEMA` = "'.mysql_real_escape_string($schema).'" ORDER BY `TABLE_NAME`');
		$tables = array();
		while ($table = mysql_fetch_row($result))
			$tables[] = $table[0];
		return $tables;
	}
}
