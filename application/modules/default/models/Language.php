<?php

//namespace Documents\Core;

/** @Document(collection="coreLanguages") */
class Language
{
	/** @Id */
	private $id;

	/** @String */
	private $name;

	public function __construct($name)
	{
		$this->name = $name;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function __toString()
	{
		return $this->name;
	}
}