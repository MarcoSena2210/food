<?php echo $this->extend('Admin/layout/principal'); ?>


<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php $this->endSection(); ?>


<!--Aqui enviamos para o template princial os estilos  -->
<?php echo $this->section('estilos'); ?>

<?php $this->endSection(); ?>

<!-- Aqui enviamos para o template princial o conteúdo  -->
<?php echo $this->section('conteudo'); ?>



<div class="row">

    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">

            <div class="card-header bg-primary pb-0 pt-4">

                <h4 class="card-title text-white"><?php echo $titulo; ?></h4>
            </div>

            <div class="card-body">



                <!-- Nomr -->
                <p class="card-text">
                    <spam class="font-weight-bold">Nome:</spam>
                    <?php echo esc($usuario->nome); ?>
                </p>
                <!-- E-mail -->
                <p class="card-text">
                    <spam class="font-weight-bold">E-mail:</spam>
                    <?php echo esc($usuario->email); ?>
                </p>
                <!-- Ativo -->
                <p class="card-text">
                    <spam class="font-weight-bold">Ativo:</spam>
                    <?php echo esc($usuario->is_ativo ? "Sim" : "Não"); ?>
                </p>
                <!-- Perfil -->
                <p class="card-text">
                    <spam class="font-weight-bold">Pefil:</spam>
                    <?php echo ($usuario->is_admin ? "Administrador" : "Cliente"); ?>
                </p>
                <!-- Criado -->
                <p class="card-text">
                    <spam class="font-weight-bold">Criado:</spam>
                    <?php echo $usuario->criado_em->humanize(); ?>
                </p>

                <!-- Não foi excluido-->
                <?php if ($usuario->deletado_em == null) : ?>

                    <!-- Atualizado -->
                    <p class="card-text">
                        <spam class="font-weight-bold">Atualizado:</spam>
                        <?php echo $usuario->atualizado_em->humanize(); ?>
                    </p>

                <?php else : ?>


                    <!-- Excluido -->
                    <p class="card-text">
                        <spam class="font-weight-bold text-danger">Excluido:</spam>
                        <?php echo $usuario->deletado_em->humanize(); ?>
                    </p>
                <?php endif ?>

                <div class="mt-4">
                    <!-- Não foi excluido-->
                    <?php if ($usuario->deletado_em == null) : ?>

                        <!-- Botão editar -->
                        <a href="<?php echo site_url("admin/usuarios/editar/$usuario->id"); ?>" class="btn btn-dark btn-rounded mr-2 btn-sm btn-icon-text ">
                            <i class="mdi mdi-checkbox-marked-circle btn-icon-prepend"></i>Editar
                        </a>
                        <!-- Botão excluir -->
                        <a href="<?php echo site_url("admin/usuarios/excluir/$usuario->id"); ?>" class="btn btn-danger btn-rounded mr-2 btn-sm btn-icon-text">
                            <i class="mdi mdi-alert btn-icon-prepend"></i>
                            </i>Excluir
                        </a>
                        <!-- Botão voltar -->
                        <a href="<?php echo site_url("admin/usuarios/index/$usuario->id"); ?>" class="btn btn-light btn-rounded mr-2 btn-sm btn-icon-text ">
                            <i class="mdi mdi-reload btn-icon-prepend"></i>
                            Voltar
                        </a>

                    <?php else : ?>

                        <a title='desfazer exclusão' href="<?php echo site_url("admin/usuarios/desfazerexclusao/$usuario->id"); ?>" class="btn btn-dark btn-rounded ml-2 btn-sm btn-icon-text">
                            <i class="mdi mdi-undu btn-icon-prepend"></i>
                            Desfazer
                        </a>

                        <!-- Botão voltar -->
                        <a href="<?php echo site_url("admin/usuarios/index/$usuario->id"); ?>" class="btn btn-light btn-rounded btn-sm btn-icon-text ">

                                <i class="mdi mdi-reload btn-icon-prepend"></i>
                                Voltar
                            </a>
                        <?php endif ?>

                </div>


            </div>
        </div>
    </div>

</div>

<?php $this->endSection(); ?>

<!-- Aqui enviamos para o template princial os scripts  -->
<?php echo $this->section('scripts'); ?>


<?php $this->endSection(); ?>