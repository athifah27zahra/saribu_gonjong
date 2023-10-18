<?= $this->extend('dashboard/layouts/main'); ?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="card">
            <div class="card-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title text-center"><?=$titlehead?></h4>
                        <!-- <td><button type="submit" class="btn btn-primary float-end">Change Booking Data</button></td> -->
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php
                if(session()->getFlashData('success')){
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('success') ?>
                  </button>
                </div>
                <?php
                }
                ?>

                <?php
                if(session()->getFlashData('danger')){
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('danger') ?>
                  </button>
                </div>
                <?php
                }
                ?>

                <?php
                if(session()->getFlashData('info')){
                ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('info') ?>
                  </button>
                </div>
                <?php
                }    
                ?>
                <form method="post">
                    <input type="hidden" name="editbook" value="true" />
                <div class="col table-responsive">
                    <table class="table table-borderless">
                      <tbody>
                      <h6>Booking Detail</h6>
                          <tr>
                              <td class="fw-bold" width="50%">Booking Status</td>
                              <td>
                                  <select class="form-control" name="status">
                                      <option value="1" <?=$booking[0]['status']==1?'selected':''?>>Pending</option>
                                      <option value="2" <?=$booking[0]['status']==2?'selected':''?>>Confirmed</option>
                                      <option value="3" <?=$booking[0]['status']==3?'selected':''?>>Unavailable</option>
                                      <option value="4" <?=$booking[0]['status']==4?'selected':''?>>Finished</option>
                                  </select>
                              </td>
                          </tr>
                            <tr>
                                <td class="fw-bold" width="50%">Username</td>
                                <td><?=$booking[0]['user_name']?></td>
                            </tr>
                          <tr>
                              <td class="fw-bold" width="50%">Booking Date</td>
                              <td><?=$booking[0]['date']?></td>
                          </tr>
                          <tr>
                              <td class="fw-bold">Total Member</td>
                              <td><?=$booking[0]['total_member']?></td>
                          </tr>
                          <tr>
                              <td class="fw-bold">Comment</td>
                              <td><?=$booking[0]['comment']?></td>
                          </tr>
                          <tr>
                              <button type="submit" class="btn btn-primary float-end">Change Booking Data</button>
                              <!-- <td></td> -->
                          </tr>
                      </tbody>
                    </table>
                  </div>
                </form>
                <hr />
                
                <form method="post">
                    <input type="hidden" name="editpack" value="true" />
                    <?php
                    if($data['package']['custom']==1) {
                        ?>
                        <button type="submit" class="btn btn-primary float-end">Change Price</button>
                        <?php
                    }
                    ?>
                <h6>Package Detail</h6>
                <div class="col table-responsive">
                  <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="fw-bold" width="50%">ID Package</td>
                            <td><?= esc($data['package']['id']) ?></td>
                        </tr>
                      <tr>
                        <td class="fw-bold" width="50%">Name</td>
                        <td><?= esc($data['package']['name']) ?></td>
                      </tr>
                      <tr>
                        <td class="fw-bold" width="50%">Package Price</td>
                        <td>
                            <?php
                            if($data['package']['custom']==1) {
                                ?>
                                <input type="text" class="form-control" name="price" value="<?=$data['package']['price']?>" />
                                <!-- <button type="submit" class="btn btn-primary float-end">Change Price</button> -->
                                <?php
                            } else {
                                ?><?= 'Rp ' . number_format(esc($data['package']['price']), 0, ',', '.'); ?><?php
                            }
                            ?>
                            
                        </td>
                      </tr>
                      <tr>
                        <td class="fw-bold" width="50%">Capacity</td>
                        <td><?= esc($data['package']['capacity'])  . ' people'; ?></td>
                      </tr>
                       <tr>
                        <td class="fw-bold" width="50%">Contact Person</td>
                        <td><?= esc($data['package']['contact_person']); ?></td>
                      </tr>
                      <tr>
                          <td class="fw-bold" width="50%">Description</td>
                          <td><?= esc($data['package']['description']); ?></td>
                      </tr>
                    </tbody>
                  </table> 
                </div>
                </form>
                <hr />
                <a href="<?=base_url("dashboard/tourismPackage/edit/".$data['package']['id'])?>" target="_blank" class="btn btn-primary float-end">Edit Package</a>
                <h6>Activities and Services Detail</h6>
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
                
                <hr />  
                <h6 class="card-title">Rating and Review</h6>
                <div class="star-containter mb-3">
                    <?php
                    $rat = 0;
                    if($booking[0]['rating']>0 && $booking[0]['rating']<=5) {
                        $rat = $booking[0]['rating'];
                    }

                    ?>
                    <i class="fa-solid fa-star fs-4 <?=$rat>=1?"star-checked":'';?>"></i>
                    <i class="fa-solid fa-star fs-4 <?=$rat>=2?"star-checked":'';?>"></i>
                    <i class="fa-solid fa-star fs-4 <?=$rat>=3?"star-checked":'';?>"></i>
                    <i class="fa-solid fa-star fs-4 <?=$rat>=4?"star-checked":'';?>"></i>
                    <i class="fa-solid fa-star fs-4 <?=$rat>=5?"star-checked":'';?>"></i>
                </div>
                <div class="col-12 mb-3">
                    <div class="form-floating">
                        <p><?=$booking[0]['review']?></p>
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
