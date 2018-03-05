<?php

namespace Hcode;

use Rain\Tpl;

/**
Classe para carregar o Template
*/
class Page {

	private $tpl;
	private $options = [];
	private $defauls = [
		"header"=>true,
		"footer"=>true,
		"data"=>[]
	];
	
	public function __construct($opts = array(), $tpl_dir = "/views"){

		$this->options = array_merge($this->defauls, $opts);

		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/$tpl_dir",
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false // set to false to improve the speed
				   );

		Tpl::configure( $config );

		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		if ($this->options["header"] === true) $this->tpl->draw("header");

	}

	private function setData($data = array()){

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}

	}

	public function setTpl($name, $data = array(), $returnHTML = false){

		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);

	}

	public function __destruct(){

		if ($this->options["footer"] === true) $this->tpl->draw("footer");

	}


}

?>