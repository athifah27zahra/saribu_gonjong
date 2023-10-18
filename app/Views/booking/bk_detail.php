<?= $this->extend('web/layouts/main'); ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="row align-items-center">
                      <div class="col">
                        <h3 class="card-title text-center"><?=$titlehead?></h4>
                      </div>
                      <div class="col-auto">
                        <?php
                    if($booking[0]['status']==1) {
                        ?>
                    <a href="<?=base_url("booking/edit/{$data['package']['id']}/{$booking[0]['date']}")?>" class="btn btn-primary float-end"><i class="fa-solid fa-pencil me-3"></i>Edit</a>
                        <?php
                    }
                    ?>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    <?php
                    if(session()->getFlashData('success')){
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashData('success') ?>
                    </div>
                    <?php
                    }
                    ?>

                    <?php
                    if(session()->getFlashData('danger')){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashData('danger') ?>
                    </div>
                    <?php
                    }
                    ?>

                    <?php
                    if(session()->getFlashData('info')){
                    ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?= session()->getFlashData('info') ?>
                    </div>
                    <?php
                    }            
                    //echo var_dump($booking);
                    $status = App\Controllers\Web\MyBooking::_setStatus($booking[0]['status']);
                    ?>
                    <!-- <h6>Detail Booking</h6> -->
                    <div class="col table-responsive">
                      <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="fw-bold" width="50%">Booking Status</td>
                                <td><?=$status?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold" width="50%">Booking Date</td>
                                <td><?=$booking[0]['date']?></td>
                            </tr>
                            <?php
                                if($data['package']['custom']==1) {
                                    ?>
                            <tr>
                                <td class="fw-bold" width="50%">Total Member</td>
                                <td><?=$booking[0]['total_member']?></td>
                            </tr>
                                    <?php
                                }
                                ?>
                            <tr>
                                <td class="fw-bold" width="50%">Comment</td>
                                <td><?=$booking[0]['comment']?></td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- <h6>Detail Paket</h6> -->
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
                            <td><?= 'Rp ' . number_format(esc($data['package']['price']), 0, ',', '.'); ?></td>
                          </tr>
                          <tr>
                            <td class="fw-bold" width="50%">Capacity</td>
                            <td><?= esc($data['package']['capacity'])  . ' people'; ?></td>
                          </tr>
                           <tr>
                            <td class="fw-bold" width="50%">Contact Person</td>
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
            <?php
            if($booking[0]['status']>3) {
                $rat = 0;
                if($booking[0]['rating']>0 && $booking[0]['rating']<=5) {
                    $rat = $booking[0]['rating'];
                }
                
                if($rat>0) {
                ?>
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <h4 class="card-title text-center">Rating and Review</h4>
                                <div class="star-containter mb-3">
                                <?php
                                for($i=1;$i<=$rat;$i++) {
                                    ?><i class="fa-solid fa-star fs-4 star-checked"></i><?php
                                }
                                ?>
                                </div>
                                <div class="col-12 mb-3">
                                <?=$booking[0]['review']?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                } else {
                ?>
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <h4 class="card-title text-center">Rating and Review</h4>
                                <form class="form form-vertical" action="<?= base_url("booking/detail/{$data['package']['id']}/{$booking[0]['date']}"); ?>" method="post" onsubmit="checkStar2(event);">
                                    <input type="hidden" name="kirim_rating" value="true" />
                                    <?php


                                    ?>
                                    <div class="form-body">
                                        <div class="star-containter mb-3">
                                            <i class="fa-solid fa-star fs-4 <?=$rat>=1?"star-checked":'';?>" id="star2-1" onclick="setStar2('star-1');"></i>
                                            <i class="fa-solid fa-star fs-4 <?=$rat>=2?"star-checked":'';?>" id="star2-2" onclick="setStar2('star-2');"></i>
                                            <i class="fa-solid fa-star fs-4 <?=$rat>=3?"star-checked":'';?>" id="star2-3" onclick="setStar2('star-3');"></i>
                                            <i class="fa-solid fa-star fs-4 <?=$rat>=4?"star-checked":'';?>" id="star2-4" onclick="setStar2('star-4');"></i>
                                            <i class="fa-solid fa-star fs-4 <?=$rat>=5?"star-checked":'';?>" id="star2-5" onclick="setStar2('star-5');"></i>
                                            <input type="hidden" id="star2-rating" value="<?=$rat?>" name="rating">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Leave a comment here"
                                                          id="floatingTextarea" style="height: 150px;" name="review"><?=$booking[0]['review']?></textarea>
                                                <label for="floatingTextarea">Leave a comment here</label>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end mb-3">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
                <?php
                }
            }
            ?>
        </div>
      <div class="col-md-6 col-12">
      <!-- Object Location on Map -->
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Google Maps</h5>
        </div>
        <div class="card-body">
          <div class="googlemaps" id="googlemaps"></div>
          <script>
            initMapNew();
            map.setCenter({
              lat: -0.02243720,
              lng: 100.34884565
            });
          </script>
          <div id="legend"></div>
          <script>
            $('#legend').hide();
            getLegend();
          </script>
          <br />
          <?php
          // $package_dayy = model('tourismPackageModel')->package_day($data['day']); 
           foreach ($data['package_day'] as $pd) {
            $loop = 0;
            $dp = model('tourismPackageModel')->detail_package_day($pd['day'], $pd['tourism_package_id']); ?>
            <script>
              function add<?= $pd['day'], $pd['tourism_package_id']; ?>() {
                initMap();
                map.setZoom(15);
                <?php 
                
                foreach ($dp as $dd) {
                  $loop++;
                  $id_object = $dd['id_object'];
                  if ('R' == substr($id_object, 0, 1)) {
                    $object = model('tourismPackageModel')->rumah_gadang($id_object);
                  } elseif ('U' == substr($id_object, 0, 1)) {
                    $object = model('tourismPackageModel')->umkm_place($id_object);
                  } elseif ('SP' == substr($id_object, 0, 2)) {
                    $object = model('tourismPackageModel')->souvenir_place($id_object);
                  } elseif ('W' == substr($id_object, 0, 1)) {
                    $object = model('tourismPackageModel')->worship_place($id_object);
                  } elseif ('O' == substr($id_object, 0, 1)) {
                    $object = model('tourismPackageModel')->tourism_object($id_object);
                  } elseif ('A' == substr($id_object, 0, 1)) {
                    $object = model('tourismPackageModel')->tourism_activity($id_object);
                  } elseif ('HP' == substr($id_object, 0, 2)) {
                    $object = model('tourismPackageModel')->history_place($id_object);
                  } else {
                    $object = model('tourismPackageModel')->study($id_object);
                  }
                  $lat_now = esc($object['lat']);
                  $lng_now = esc($object['lng']); ?>
                  
                  objectMarker("<?= esc($object['id']); ?>", <?= $lat_now; ?>, <?= $lng_now; ?>, true, <?= $loop; ?>);
                  <?php if (1 < $loop) { ?>
                    // new01(<?= $lat_bef; ?>, <?= $lng_bef; ?>, <?= $lat_now; ?>, <?= $lng_now; ?>);
                    pointA<?= $loop; ?> = new google.maps.LatLng(<?= $lat_bef; ?>, <?= $lng_bef; ?>);
                    pointB<?= $loop; ?> = new google.maps.LatLng(<?= $lat_now; ?>, <?= $lng_now; ?>);
                    directionsService<?= $loop; ?> = new google.maps.DirectionsService;
                    directionsDisplay<?= $loop; ?> = new google.maps.DirectionsRenderer({
                      suppressMarkers: true,
                      map: map
                    });
                    directionsService<?= $loop; ?>.route({
                      origin: pointA<?= $loop; ?>,
                      destination: pointB<?= $loop; ?>,
                      avoidTolls: true,
                      avoidHighways: false,
                      travelMode: google.maps.TravelMode.DRIVING
                    }, function(response, status) {
                      if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay<?= $loop; ?>.setDirections(response);
                      } else {
                        window.alert('Directions request failed due to ' + status);
                      }
                    });
                  <?php } ?>
                  <?php $lat_bef = $lat_now;
                  $lng_bef = $lng_now; ?>
                <?php 
                }
                ?>
                 
              }
            </script>
            <!-- <button class="btn btn-sm btn-primary" onclick="add Route</button> -->
            <button class="btn btn-sm btn-primary" onclick="add<?= $pd['day'],$pd['tourism_package_id']; ?>();">Day <?= $pd['day']; ?> Route</button>
          <?php } ?>
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

