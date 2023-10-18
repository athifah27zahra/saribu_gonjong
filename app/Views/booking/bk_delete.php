<?= $this->extend('web/layouts/main'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <div class="col-12">

<div class="card">
    <div class="card-body">
        <h3><?=$titlehead?></h3>
        <hr />
        <?php
                if(session()->getFlashData('success')!=null){
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php
                }
                if(session()->getFlashData('danger')!=null || (isset($error) && $error!='')){
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('danger') ?> 
                    <?= $error ?>
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php
                }
                if(session()->getFlashData('info')!=null){
                ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('info') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php
                }   
                ?>
        Anda yakin untuk menghapus?
        <form method="post">
            <div class="form-group">
                <label>Booking Date</label>
                <input type="text" class="form-control" disabled="" value="<?=$booking[0]['date']?>" />
            </div>
            <div class="form-group">
                <label>Jumlah Anggota</label>
                <input type="text" class="form-control" disabled="" value="<?=$booking[0]['total_member']?>" />
            </div>
            <div class="form-group">
                <label>Comment</label>
                <textarea class="form-control" disabled=""><?=$booking[0]['comment']?></textarea>
            </div>
            <h6>Detail Package</h6>
            <div class="col table-responsive">
              <table class="table table-borderless">
                <tbody>
                  <tr>
                    <td class="fw-bold">Name</td>
                    <td><?= esc($data['package']['name']) ?></td>
                  </tr>
                  <tr>
                    <td class="fw-bold">Package Price</td>
                    <td><?= 'Rp ' . number_format(esc($data['package']['price']), 0, ',', '.'); ?></td>
                  </tr>
                  <tr>
                    <td class="fw-bold">Capacity</td>
                    <td><?= esc($data['package']['capacity'])  . ' people'; ?></td>
                  </tr>
                  <tr>
                    <td class="fw-bold">Contact Person</td>
                    <td><?= esc($data['package']['contact_person']); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="row">
                <div class="col">
                  <p class="fw-bold">Description</p>
                  <p><?= esc($data['package']['description']); ?></p>
                </div>
            </div>
            <hr />
            <?php
            foreach((array)$data['package_day'] as $pd) {
            ?>
            <div class="row">
              <div class="col">
                <p class="fw-bold">Activities (Day <?= $pd['day'] ?>)</p>
                <p><?=$pd['description']?></p>
                <?php $i = 1; ?>
                <?php 
                if(isset($data['package_det'][$pd['day']])) {
                    foreach ((array)$data['package_det'][$pd['day']] as $dd) : 
                        ?>
                        <p style="margin-left: 15px"><?= esc($i) . '. ' . esc($dd['description']); ?></p>
                        <?php
                        $i++;
                    endforeach; 
                }
                ?>
              </div>
            </div>            
            <?php
            }
            ?>
            <div class="row">
                <div class="col">
                  <p class="fw-bold">Service</p>
                  <?php $i = 1; ?>
                  <?php foreach ($data['service'] as $f) : ?>
                    <p><?= esc($i) . '. ' . esc($f['service_package_name']); ?></p>
                    <?php $i++; ?>
                  <?php endforeach; ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="fw-bold">Non Service</p>
                    <?php $i = 1; ?>
                    <?php foreach ($data['servnon'] as $nf) : ?>
                      <p><?= esc($i) . '. ' . esc($nf['service_package_name']); ?></p>
                      <?php $i++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <input type="hidden" name="submit" value="hapus" />
            <br /><br />
            <button class="btn btn-primary" type="submit">Hapus</button>
            <br /><br />
        </form>
        <a href="<?=base_url("booking/my")?>" class="btn btn-primary">Kembali ke halaman sebelumnya</a>
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