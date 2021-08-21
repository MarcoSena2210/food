<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'titulo' => 'Home da áera restrita',
		];
		return view('Admin/Home/index', $data);
	}
	
}
