<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Usuario1 extends Seeder
{
	public function run()	{
		$usuarioModel = new \App\Models\UsuarioModel;

		// Truncar a tabela, sql puro, vai limpar todos os registros  
	   	$usuarioModel->query("TRUNCATE usuarios");
	
		$qt_regs = 10;
		for ($i = 1; $i <= $qt_regs; $i++) {
			$prefix = rand(1000, 9999);
			$suffix = rand(1000, 9999);
	
	    	$usuario = [
			 	'nome' => "Lucio$i Antonio de Souza",
			 	'email' => "admin$i@admin.com",
			 	'telefone' => "71 9-$prefix-$suffix",
			];
			// desabilitar momentaneamente a proteção protect(false) 
		 	$usuarioModel->protect(false)->insert($usuario);
		    //dd($usuarioModel->errors()); 
		}
	}
}
