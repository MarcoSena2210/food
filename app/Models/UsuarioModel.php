<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
	protected $table                = 'usuarios';
	protected $returnType           = 'App\Entities\Usuario';
	/** Só campos allowedfields são manipulados lá no banco de dados, é uma proteção
	 * só eles serão populados, evitando a manipulação através da pagina por algum
	 * haquer  	  */
	protected $allowedFields        = ['nome', 'email', 'telefone'];


	//datas
	protected $useTimestamps 		= true;
	protected $createdField  		= 'criado_em';
	protected $updatedField  		= 'atualizado_em';
	protected $dataFormat			= 'datatime'; //Para uso com o $useSoftDeletes 
	protected $useSoftDeletes       = true;       //Não exclui fisicamente, grava a data apenas 
	protected $deletedField         = 'deletado_em';

	//Validações
	protected $skipValidation       = false;	
	protected $validationRules    = [
		'nome'       			=> 'required|alpha_numeric_space|min_length[3]|max_length[127]',
		'email'      			=> 'required|valid_email|is_unique[usuarios.email]',
		'cpf'       			=> 'required|exact_length[14]|validaCpf|is_unique[usuarios.cpf]',
		'telefone'     			=> 'required',
		'password'          	=> 'required|min_length[6]',
		'password_confirmation' => 'required_with[password]|matches[password]'
	];

	protected $validationMessages = [
		'nome'        => [
			'required'  => 'O campo "NOME" é obrigatório.',
		],
		'email'        => [
			'required'  => 'O campo "E-MAIL" é obrigatório.',
			'is_unique' => 'Desculpe. Esse email já existe.'
		],

		'cpf'        => [
			'required'  => 'O campo é "CPF" é obrigatório.',
			'is_unique' => 'Desculpe. Esse cpf já existe.'
		],
		'password_confirmation'  => [
			'required_with'  => 'O campo "CONFIRMA SENHA " é obrigatório quando a senha estiver senhdo alterada.',
			'matches'	     => 'O campo "CONFIRME SUA SENHA " não é igual ao campo "SENHA".'  
		]

	];

	/** Eventos callback, chama a função hashPassword  antes de inseri e antes de atualizar ref au42*/
	protected $beforeInsert = ['hashPassword'];
	protected $beforeUpdate = ['hashPassword'];


	/* Encriptografa a senha para salvar o banco */
	protected function hashPassword(array $data){
		/** Se veio a password do form,
		 *  então atribui ao campo do meu banco de dados. 
		 *  campo do banco 'password_hash'  o valor retornado da função  
		 *  <password_hash()>
		 */
		if (isset($data['data']['password'])){
			/** Cmpo da base de dados $data['data']['password_hash'] 
			 * Função do PHP <password_hash($data['data']['password'], PASSWORD_DEFAULT)> */	
			$data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
           
			/** Remove do meu array a senha recebida e a senha confirmada  */
			unset($data['data']['password']);
			unset($data['data']['password_confirmation']);	
		} 
		//dd($data);
		return $data;
	
	}

	/**
	 * @uso  Método para buscar um usuário através do autocomplete
	 * usando ajax jquery	 
	 * @param string $term
	 * @return array usuários 
	 * 
	*/
	public function procurar($term){
           
		/** Não foi passado nada */
		if($term === null){
		//	dd("Aqui");
			return [];
		} 

		return $this->select('id, nome')
			->like('nome', $term)
			->get()
			->getResult();

	}

	/**
	 * @uso  Método criado para ser usado na atualização do usuário.
	 * Pois nessa operação não será obrigatório a digitação de senha etão pouco a confirmação
	 * usando ajax jquery	 
	 * @param string $term
	 * @return array usuários 
	 * 
	 */
	public function desabilitaValidacaoSenha(){
		unset($this->validationRules['pasword']);
		unset($this->validationRules['password_confirmation']);
	}

	public function desfazerExclusao(int $id){

		return $this->protect(false)
					->where('id', $id)
					->set('deletado_em',null)
					->update(); 
	}

}
