<?php

use \NS\Meta\Model\Model;

class User extends Model
{
	protected $_id;
	protected $_name;
	protected $_password;
	protected $_groupID;
	protected $_isAdmin = false;

	protected $_group;
}
