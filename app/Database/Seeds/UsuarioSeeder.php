<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use DateTime;

class UsuarioSeeder extends Seeder {
	public function run()	{
		$usuarioModel = new \App\Models\UsuarioModel;

		$usuario = [
			'nome' => 'Lucio2 Antonio de Souza',
			'email' =>'admin@admin.com',
			'telefone' => '41 - 9999-99999 ',
			'cpf' => '219.488.760-19',
    	];
		$usuarioModel->protect(false)->insert($usuario);

		$usuario = [
			'nome' => 'Fulano de tal2',
			'email' => 'fulanodetal@gmail.com',
			'telefone' => '41 - 8888-99999 ',
			'cpf' => '930.643.530-47',
			
		];
		$usuarioModel->protect(false)->insert($usuario);   
		dd($usuarioModel->errors());

	
    }
}	
