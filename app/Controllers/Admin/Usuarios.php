<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Entities\Usuario;

class Usuarios extends BaseController{
	
	private $usuarioModel;

	public function __construct(){
		
		$this->usuarioModel = new \App\Models\UsuarioModel();
		
	}
    
	/** @uso Exibe a lista de usuários cadastrados
	 *  @param nenhum
	 *  @return objeto usuario 
	 */ 
	public function index() {
		$data =[
			'titulo'=>'Listando usuários',
			'usuarios' => $this->usuarioModel->withDeleted('true')->paginate(5), // mostra os deletados 'usuarios' => $this->usuarioModel->findAll()neste caso não mostra os deletados  
		    'pager' => $this->usuarioModel->pager,                               // substituido pela paginação   
	                                                                     //
		];
		return view ('Admin/Usuarios/Index',$data);
	}


	/** @uso  Procura o nome digitado pelo usuário no banco de daos fazendo um filtro dentro da lista. 
	 *   Esse método só aceita a requisão via ajax, através do input da view   
	 *  @param nenhum
	 *  @return objeto usuario 
	 * 
	 */ 
	public function procurar() {
		if (!$this->request->isAJAX()) {
			exit('Recurso não encontrado');
		}		
		
		/** Recebe o valor do campos  */
		$usuarios = $this->usuarioModel->procurar($this->request->getGet('term'));
		$retorno = [];

		foreach ($usuarios as $usuario){

			$data['id'] = $usuario->id;
			$data['value'] = $usuario->nome;
			$retorno[] = $data;
		}

		return $this->response->setJSON($retorno);

	}



	/** @uso  
	 *  @param nenhum
	 *  @return objeto usuario 
	 */ 
	public function criar()
	{
        /* Nesse  caso é um entity */
		$usuario = new Usuario();
	
		$data = [
			'titulo' 	=> "Criando novo usuário",
			'usuario' 	=> $usuario, 
		];
		return view('Admin/Usuarios/criar', $data);
	}



	/** @uso  Efetua todo o processamento dos dados inseridos pelo usuario no form novo,
     *  e chama o usuarioMdel para salvar no banco, após a inserção pega o ultimo Id criado 
	 *  com o getInsertID() e passa para o form SHOW
	 *  @param requisição post
	 *  @return Messagem de sucesso ou erro
	 */
	public function cadastrar()	{

		/** Esse método só aceita a requisão via POST */
		if ($this->request->getMethod() === 'post') {

	
			$usuario = new Usuario($this->request->getPost() );
				
			
			/**  Atualização feita com sucesso ou  erro informa ao usuário*/
			if ($this->usuarioModel->protect(false)->save($usuario)) {
				//dd($usuario);	     
				return redirect()->to(site_url("admin/usuarios/show/" .$this->usuarioModel->getInsertID()))
				->with('sucesso', "O usuário $usuario->nome cadastrado com sucesso");

			} else {
				//dd($usuario);	
				//Erro
				return redirect()->back()
					->with('errors_model', $this->usuarioModel->errors())
					->with('atencao', 'Por favor verifique os erros abaixo')
					->withInput();
			}
		} else {
			//	dd("fora do AQUI");
			//return redirect()->back();
			/**  Teste da exibição das mensagem 
			 *	return redirect()->back()->with('info','Por favor envie um post');
			 *	return redirect()->back()->with('sucesso', 'sucesso');
			 *	return redirect()->back()->with('atencao', 'Por favor mais atenção');
			 */
			return redirect()->back();
		}
	}	



	/** @uso  Chama o formulario que irá mostrar os detalhes do usuário.
	 *        e os botões de editar, excluir e voltar  
	 *  @param id (Código do usuário)
	 *  @return pagina contendo os dados
	 */ 
	public function show($id = null){
		$usuario = $this->buscaUsuarioOu404($id);
		//dd($usuario);
		$data = [
			'titulo' 	=>"Detalhando o usuário $usuario->nome",
			'usuario' 	=> $usuario, 
		];
		return view('Admin/Usuarios/show', $data);
	}


	

	/** @uso  Chama o formulario para edição dos detalhes pelo usuário.
	 *        
	 *  @param id (Código do usuário)
	 *  @return pagina contendo os dados ebertos para edição
	 */ 	
	public function editar($id = null)	{
		$usuario = $this->buscaUsuarioOu404($id);

        /** Usuario excluído não permitir editar, proteção caso alguém tente direto pela url no browse */
		if($usuario->deletado_em != null){
			return redirect()->back()->with('info',"O usuário $usuario->nome encontra-se excluído. Portanto, não épossível editá-lo." );
		}	



		//dd($usuario);
		$data = [
			'titulo' 	=> "Editando o usuário $usuario->nome",
			'usuario' 	=> $usuario,
		];
		return view('Admin/Usuarios/editar', $data);
	}


	/** @uso  Efetua todo o processamento dos dados editados pelo usuario,
	 *  fazendos as primeiras criticas e passa a responsabilidade de arnmazenamento 
	 *  para o medel
	 *  @param id (Código do usuário)
	 *  @return Messagem de sucesso ou erro
	 */ 	
	public function atualizar($id = null)		{
	
		/** Esse método só aceita a requisão via POST */
		if ($this->request->getMethod() === 'post') {

			//dd("AQUI");
			$usuario = $this->buscaUsuarioOu404($id);

			/** Usuario excluído não permitir editar, proteção caso alguém tente direto pela url no browse */
			if ($usuario->deletado_em != null) {
				return redirect()->back()->with('info', "O usuário $usuario->nome encontra-se excluído. Portanto, não épossível atualizá-lo.");
			}	


            
			//dd($usuario);
            $post = $this->request->getPost();
			//dd($post);
            /** Usuário nãa alterou a senha
			 *  Então desabilitaos a validações e retirampos
			 *  do array post 	 */
			if(empty($post['password'])){
				$this->usuarioModel->desabilitaValidacaoSenha();
				/** Removendo do post */
				unset($post['password']);
				unset($post['password_confirmation']);
			} 
			$usuario->fill($post);
			//dd($usuario);

            /** Não houve alterações, voltamos sem ir ao SGBD  */   
			if (!$usuario->hasChanged()) {
				return redirect()->back()->with('info','Não houve alteração para atualizar no banco de dados');
			}
            /**  Atualização feita com sucesso ou  erro informa ao usuário*/ 
			if($this->usuarioModel->protect(false)->save($usuario)){
				return redirect()->to(site_url("admin/usuarios/show/$usuario->id"))
				                 ->with('sucesso',"o usuário $usuario->nome teve seus dados atualizados com sucesso");
			} else { 
				//Erro
				return redirect()->back()
								->with('errors_model', $this->usuarioModel->errors())
								->with('atencao', 'Por favor verifique os erros abaixo')->withInput();		
			}
		}else{
	    	//	dd("fora do AQUI");
			//return redirect()->back();
			/**  Teste da exibição das mensagem 
			*	return redirect()->back()->with('info','Por favor envie um post');
			*	return redirect()->back()->with('sucesso', 'sucesso');
		    *	return redirect()->back()->with('atencao', 'Por favor mais atenção');
		   	*/
			return redirect()->back()->with('error', 'Não faça tentativa de enviar pelo GET, não irá conseguir!!');
		}
	}



	/** @uso  Chama o formulario que irá mostrar os detalhes do usuário.
	 *        e os botões de editar, excluir e voltar  
	 *  @param id (Código do usuário)
	 *  @return pagina contendo os dados
	 */
	public function excluir($id = null)	{
		$usuario = $this->buscaUsuarioOu404($id);


		/** Usuario excluído não permitir excluir, proteção caso alguém tente direto pela url no browse */
		if ($usuario->deletado_em != null) {
			return redirect()->back()->with('info', "O usuário $usuario->nome já encontra-se excluído.");
		}	



        //Administrador não pode ser excluído
		if($usuario->is_admin){
			return redirect()->back()->with('info','Não é possível excluir um usuário <b>Administrador</b>');
		}



		if($this->request->getMethod() === 'post'){
			$this->usuarioModel->delete($id);
			return redirect()->to(site_url('Admin/usuarios'))->with('sucesso',"Usuário $usuario->nome excluído com sucesso!");
		}
		//dd($usuario);
		$data = [
			'titulo' 	=> "Excluindo o usuário $usuario->nome",
			'usuario' 	=> $usuario,
		];
		return view('Admin/Usuarios/excluir', $data);
	}



	/** @uso  reativa um registtro que foi deletado, possue data 
	 *        de deletado_em_ 
	 *  @param id (Código do usuário)
	 *  @return pagina contendo os dados ebertos para edição
	 */
	public function desfazerExclusao($id = null)
	{
		$usuario = $this->buscaUsuarioOu404($id);
	
		if($usuario->deletado_em ==null){

		//	dd($usuario->id);
			return redirect()->back()->with('info','Apenas usuários excluídos podem ser recuperados');
		}

		if($this->usuarioModel->desfazerExclusao($id)) {
			return redirect()->back()->with('success','Exclusão desfeita.');
		}else {
			return redirect()->back()
				->with('errors_model', $this->usuarioModel->errors())
				->with('atencao', 'Por favor verifique os erros abaixo')->withInput();	
		}

	}
 


	/** @uso Busca um usuário por seu código "ID"
	 *  @param int $id 
	 *  @return objeto usuario 
	*/ 
	private function buscaUsuarioOu404(int $id = null) {
         
		if (!$id || !$usuario = $this->usuarioModel->withDeleted(true)->where('id', $id)->first() ){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o usuário $id");
		}
		return $usuario;

	}


}
