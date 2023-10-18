<?= $this->extend('web/layouts/main'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="row align-items-center">
              <div class="col">
                <h4 class="card-title text-center"><?=$titlehead?></h4>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Please complete the phone number in the "My Profile" section!
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
            <?php
            if(session()->getFlashData('success')!=null){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('success') ?>
            </div>
            <?php
            }
            if(session()->getFlashData('danger')!=null){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('danger') ?>
            </div>
            <?php
            }
            if(session()->getFlashData('info')!=null){
            ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('info') ?>
            </div>
            <?php
            }   
            ?>
            <form method="post" action="<?=base_url("booking/checkout")?>">
                <input type="hidden" name="idpackage" value="<?=$data['idpackage']?>" />
                <input type="hidden" name="book_anggota" value="<?=$data['package']['capacity']?>" />
                <div class="form-group date">
                    <label>Booking Date</label>
                    <input type="text" class="form-control" id="datepickerVH" value="<?=isset($form['book_tanggal'])?$form['book_tanggal']:date("Y-m-d");?>" name="book_tanggal">
                </div>
                <div class="form-group">
                    <label>Comment</label>
                    <textarea class="form-control" name="book_keterangan"><?=isset($form['book_keterangan'])?$form['book_keterangan']:''?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control btn-primary" name="order" value="Booking Now" />
                </div>
            </form>
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
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
    });
    $('#datepickerVH').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '+1d',
    });
</script>
<?= $this->endSection() ?>

