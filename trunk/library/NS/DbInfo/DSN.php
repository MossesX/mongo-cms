<?php

namespace NS\DbInfo;

class DSN
{
	/**
	 * Connection type
	 * @var string
	 */
	private $_type;

	/**
	 * Username
	 * @var string
	 */
	private $_userName;

	/**
	 * Password
	 * @var string
	 */
	private $_password;

	/**
	 * Host
	 * @var string
	 */
	private $_host;

	/**
	 * Database name
	 * @var string
	 */
	private $_dbName;

	/**
	 * Constructor
	 *
	 * @param string $dsn
	 */
	public function __construct($dsn)
	{
		$components = parse_url($dsn);
		$this->setType($components['scheme']);
		$this->setUserName($components['user']);
		$this->setPassword(isset($components['pass']) ? $components['pass'] : '');
		$this->setHost($components['host']);
		$this->setDbName(substr($components['path'], 1));
	}

	/**
	 * To string magic
	 *
	 * @return string
	 */
	public function __toString()
	{
		return sprintf('%s://%s:%s@%s/%s',
			$this->getType(),
			$this->getUserName(),
			$this->getPassword(),
			$this->getHost(),
			$this->getDbName()
		);
	}

	/**
	 * Type setter
	 *
	 * @param string $type
	 * @return DSN
	 */
	public function setType($type)
	{
		$this->_type = $type;
		return $this;
	}

	/**
	 * Type getter
	 *
	 * @return string
	 */
	public function getType()
	{
		return $this->_type;
	}

	/**
	 * User name setter
	 *
	 * @param string $userName
	 * @return DSN
	 */
	public function setUserName($userName)
	{
		$this->_userName = $userName;
		return $this;
	}

	/**
	 * User name getter
	 *
	 * @return string
	 */
	public function getUserName()
	{
		return $this->_userName;
	}

	/**
	 * Password setter
	 *
	 * @param string $password
	 * @return DSN
	 */
	public function setPassword($password)
	{
		$this->_password = $password;
		return $this;
	}

	/**
	 * Password name getter
	 *
	 * @return string
	 */
	public function getPassword()
	{
		return $this->_password;
	}

	/**
	 * Host setter
	 *
	 * @param string $host
	 * @return DSN
	 */
	public function setHost($host)
	{
		$this->_host = $host;
		return $this;
	}

	/**
	 * Host getter
	 *
	 * @return string
	 */
	public function getHost()
	{
		return $this->_host;
	}

	/**
	 * Database name setter
	 *
	 * @param string $dbName
	 * @return DSN
	 */
	public function setDbName($dbName)
	{
		$this->_dbName = $dbName;
		return $this;
	}

	/**
	 * Database name getter
	 *
	 * @return string
	 */
	public function getDbName()
	{
		return $this->_dbName;
	}
}
