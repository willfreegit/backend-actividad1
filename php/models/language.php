<?php
class Language
{
	private $id;
	private $language_isocode;
	private $language_name;

	public function __construct()
	{
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setLanguage_isocode($language_isocode)
	{
		$this->language_isocode = $language_isocode;
	}

	public function getLanguage_isocode()
	{
		return $this->language_isocode;
	}

	public function setLanguage_name($language_name)
	{
		$this->language_name = $language_name;
	}

	public function getLanguage_name()
	{
		return $this->language_name;
	}


}

?>