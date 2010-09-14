<?php

namespace NS\Meta\Builder;

use \NS\Core\Cls\Fluent;

class Model extends Fluent
{
	protected $_fileName;

	public function build()
	{
		$xml = \simplexml_load_file($this->getFileName());
		foreach ($xml->models->model as $model)
			var_dump($model['name'].'');

		return $this;
	}
}
