<?php

namespace NS\Meta;

use \NS\Core\Cls\Fluent;

class Builder extends Fluent
{
	protected $_fileName;

	public function build()
	{
		$xml = \simplexml_load_file($this->getFileName());
		foreach ($xml->models->model as $model){
			$strModel = '';
		}
		
		return $this;
	}
}
