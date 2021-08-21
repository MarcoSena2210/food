<?php echo $this->extend('Admin/layout/principal'); ?>


<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php $this->endSection(); ?>



<!--Aqui enviamos para o template princial os estilos  -->
<?php echo $this->section('estilos'); ?>

<?php $this->endSection(); ?>


<!-- Aqui enviamos para o template princial o conteúdo  -->
<?php echo $this->section('conteudo'); ?>
    <?php echo $titulo; ?>
<?php $this->endSection(); ?>




<!-- Aqui enviamos para o template princial os scripts  -->
<?php echo $this->section('scripts'); ?>

<?php $this->endSection(); ?>