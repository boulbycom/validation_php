<?php
namespace App;

class Request{
	public $url;
	public $data;

	public function __construct($url){
		$this->url = $url;
		
		if(isset($_POST) AND !empty($_POST)){
			$this->data = new \stdClass();
			foreach ($_POST as $field => $value) {
				$this->data->$field = $value;
			}
		}
	}
}
