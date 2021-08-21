<?php echo $this->extend('Admin/layout/principal'); ?>


<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php $this->endSection(); ?>


<!--Aqui enviamos para o template princial os estilos  -->
<?php echo $this->section('estilos'); ?>


<link rel="stylesheet" href="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>" />


<?php $this->endSection(); ?>





<!-- Aqui enviamos para o template princial o conteúdo  -->
<?php echo $this->section('conteudo'); ?>

<div class="row">

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $titulo; ?></h4>

                <div class="ui-widget">
                    <input id="query" name="query" placeholder="Pesquise por um usuário" class="form-control bg-light mb-5">
                </div>


                <a href="<?php echo site_url("admin/usuarios/criar"); ?>" class="btn btn-success btn-rounded float-right  mr-2 btn-sm">
                    <i class="mdi mdi-plus btn-icon-prepend"></i>
                    Novo
                </a>



                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>Ativo</th>
                                <th>Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario) : ?>
                                <tr>
                                    <td><?php echo $usuario->id; ?></td>
                                    <td>
                                        <a href="<?php echo site_url("admin/usuarios/show/$usuario->id"); ?>"> <?php echo $usuario->nome; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $usuario->email; ?></td>
                                    <td><?php echo $usuario->cpf; ?></td>
                                    <td><?php echo ($usuario->is_ativo && $usuario->deletado_em == null ?
                                            '<label class="badge badge-primary btn-rounded btn-sm">SIM</label>' :
                                            '<label class="badge badge-danger btn-rounded btn-sm">Não</label>'); ?> </td>

                                    <td>

                                        <?php echo ($usuario->deletado_em == null ?
                                            '<label class="badge badge-primary btn-rounded btn-sm">Disponível</label>' :
                                            '<label class="badge badge-danger btn-rounded btn-sm">Excluído</label>'); ?>

                                        <!--  Desfazer exclusao-->
                                        <?php if ($usuario->deletado_em != null) : ?>

                                            <a href="<?php echo site_url("admin/usuarios/desfazerexclusao/$usuario->id"); ?>" class="badge badge-dark ml-2">
                                                <i class="mdi mdi-undu btn-icon-prepend"></i>
                                                Desfazer
                                            </a>
                                        <?php endif; ?>

                                    </td>

                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>Ativo</th>
                                <th>Situação</th>
                            </tr>
                        </thead>
                    </table>

                    <!-- Paginação-->
                    <div class="mt-3">

                         <?php echo $pager->links() ?>                   

                    </div>
                    <!-- Paginação-->

                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->endSection(); ?>








<!-- Aqui enviamos para o template princial os scripts  -->
<?php echo $this->section('scripts'); ?>

<script src="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.js'); ?>"> </script>

<script>
    $(function() {

        $("#query").autocomplete({
            source: function(request, response) {

                $.ajax({
                    url: "<?php echo site_url('admin/usuarios/procurar'); ?>",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        if (data.length < 1) {

                            var data = [{
                                label: 'usuario não encontrado',
                                value: -1
                            }];

                        }
                        response(data); // Aqui temos valor no data
                    },

                }); // fim ajax

            }, //Fim fuction request/response 
            minLenght: 1,
            select: function(event, ui) {

                if (ui.item.value == -1) { //Não foi encontrado nenhum registro

                    $(this).val(""); //Limpa nosso input
                    return false;
                } else { //Foi encontrato o valor 

                    window.location.href = '<?php echo site_url('admin/usuarios/show/'); ?>' + ui.item.id;
                }
            }

        }); // fim autocomplete 

    }); //Fim da funcion
</script>

<?php $this->endSection(); ?>