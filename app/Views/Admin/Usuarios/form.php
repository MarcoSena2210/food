 <div class="form row">
     <div class="form-group col-md-7">
         <label class="font-weight-bold" for="nome">Nome</label>
         <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('nome', esc($usuario->nome)); ?>">
     </div>

     <div class="form-group col-md-5">
         <label class="font-weight-bold" for="cpf">CPF</label>
         <input type="text" class="form-control cpf" name="cpf" id="cpf" value="<?php echo old('cpf',  esc($usuario->cpf)); ?>">
     </div>
 </div>
 <div class="form row">
     <div class="form-group col-md-7">
         <label class="font-weight-bold" for="email1">E-mail</label>
         <input type="email" class="form-control" name="email" id="email" value="<?php echo old('email', esc($usuario->email)); ?>">
     </div>
     <div class=" form-group col-md-5">
         <label class="font-weight-bold" for="telefone">Telefone</label>
         <input type="text" class="form-control sp_celphones" name="telefone" id="telefone" value="<?php echo old('telefone',  esc($usuario->telefone)); ?>">
     </div>
 </div>

 <div class="form row">
     <div class="form-group col-md-4">
         <label class="font-weight-bold" for="password">Senha</label>
         <input type="password" class="form-control" name="password" id="password">
     </div>_

     <div class=" form-group col-md-4">
         <label class="font-weight-bold" for="password_confirmation" class="bold">Confirme sua senha</label>
         <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
     </div>

 </div>



 <div class="form row">
     <div class="form-group col-md-4">
         <label class="font-weight-bold" for="email1">Perfil</label>

         <div class="form-check form-check-flat form-check-primary mb2">
             <label for="is_admin" class="form-check-label">
                 <input type="hidden" name="is_admin" value="0">
                 <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1" <?php if (old('is_admin', $usuario->is_admin)) : ?> checked="" <?php endif; ?>>
                 Administrador
             </label>
         </div>
     </div>

     <div class=" form-group col-md-4">
         <label class="font-weight-bold" for="email1">Status</label>
         <div class="form-check form-check-flat form-check-primary mb2">
             <label for="is_ativo" class="form-check-label">
                 <input type="hidden" name="is_ativo" value="0">
                 <input type="checkbox" class="form-check-input" id="is_ativo" name="is_ativo" value="1" <?php if (old('is_ativo', $usuario->is_ativo)) : ?> checked="" <?php endif; ?>>
                 Ativo
             </label>
         </div>
     </div>
 </div>

 <button type="submit" class="btn btn-primary btn-rounded mr-2 btn-sm">
     <i class="mdi mdi-checkbox-marked-circle btn-icon-prepend mr-2"></i>
     Salvar
 </button>

 