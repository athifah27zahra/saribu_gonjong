<?= $this->extend('web/layouts/main'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <div class="col-12">

<div class="card">
    <div class="card-body">
        <h3><?=$titlehead?></h3>
        <hr />
        <a href="<?=base_url("booking/keranjang/".$idpackage)?>" class="btn btn-primary">Kembali ke halaman sebelumnya</a>
    </div>
</div>
            
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    
</script>
<?= $this->endSection() ?>