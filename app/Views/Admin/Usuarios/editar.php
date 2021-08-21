<?php echo $this->extend('Admin/layout/principal'); ?>


<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php $this->endSection(); ?>


<!--Aqui enviamos para o template princial os estilos  -->
<?php echo $this->section('estilos'); ?>

<?php $this->endSection(); ?>

<!-- Aqui enviamos para o template princial o conteúdo  -->
<?php echo $this->section('conteudo'); ?>



<div class="row">

    <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">

            <div class="card-header bg-primary pb-0 pt-4">

                <h4 class="card-title text-white"><?php echo $titulo; ?></h4>
            </div>

            <div class="card-body">

                <?php if (session()->has('errors_model')) : ?>

                    <ul>
                        <?php foreach (session('errors_model') as $error) : ?>

                            <li class="text-danger"><?php echo $error; ?> </li>

                        <?php endforeach; ?>
                    </ul>

                <?php endif; ?>



                <?php echo form_open("admin/usuarios/atualizar/$usuario->id"); ?>
                <!-- Para usar o helper codeigneter  -->

                <?php echo $this->include('Admin/Usuarios/form'); ?>


                <a href="<?php echo site_url("admin/usuarios/show/$usuario->id"); ?>" class="btn btn-light btn-rounded mr-2 btn-sm">
                    <i class="mdi mdi-reload btn-icon-prepend"></i>
                    Voltar
                </a>

                <?php echo form_close(); ?>


            </div>
        </div>
    </div>

</div>

<?php $this->endSection(); ?>

<!-- Aqui enviamos para o template princial os scripts  -->
<?php echo $this->section('scripts'); ?>

<script src="<?php echo site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"> </script>
<script src="<?php echo site_url('admin/vendors/mask/app.js'); ?>"> </script>

<?php $this->endSection(); ?>