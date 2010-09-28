<?php

namespace NS\Modules\Core\Model;

use \NS\Meta\Model\Model;

class Site extends Model
{
	protected $_id;
	protected $_name;
	protected $_password;
	protected $_groupID;
	protected $_isAdmin = false;

	protected $_group;
}
