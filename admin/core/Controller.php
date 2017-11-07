<?php

namespace Hexacore;

class Controller{
	protected $model;
	protected $view;

	public function __construct(){
		$this->model = new Model();
		$this->view = new View($this->model);
	}
}
?>