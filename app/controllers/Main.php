<?php

require APPPATH.'libraries/Crystal.php';

class Main extends Crystal {

	public function index()
	{
		// $data['content'] = 'dashboard';
		template(title:'Dashboard');
	}
	
}
