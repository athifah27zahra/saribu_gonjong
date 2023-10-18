<?= $this->extend('web/layouts/main'); ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="row">
    <script>
      currentUrl = '<?= current_url(); ?>';
    </script>

    <!-- Object Detail Information -->
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="row align-items-center">
              <div class="col">
                <h4 class="card-title text-center">Tourism Package Information</h4>
                <div class="text-center">
                  <?php for ($i = 0; $i < (int)esc($data['avg_rating']); $i++) { ?>
                    <span class="material-symbols-outlined rating-color">star</span>
                  <?php } ?>
                  <?php for ($i = 0; $i < (5 - (int)esc($data['avg_rating'])); $i++) { ?>
                    <span class="material-symbols-outlined">star</span>
                  <?php } ?>
                </div>
              </div>
              <div class="col-auto">
                <a href="<?= base_url('dashboard/tourismPackage/edit'); ?>/<?= esc($data['id']); ?>" class="btn btn-primary float-end"><i class="fa-solid fa-pencil me-3"></i>Edit</a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col table-responsive">
              <table class="table table-borderless">
                <tbody>
                  <tr>
                    <td class="fw-bold">Name</td>
                    <td><?= esc($data['name']) ?></td>
                  </tr>
                  <tr>
                    <td class="fw-bold">Package Price</td>
                    <td><?= 'Rp ' . number_format(esc($data['price']), 0, ',', '.'); ?></td>
                  </tr>
                  <tr>
                    <td class="fw-bold">Capacity</td>
                    <td><?= esc($data['capacity'])  . ' people';; ?></td>
                  </tr>
                  <tr>
                    <td class="fw-bold">Contact Person</td>
                    <td><?= esc($data['contact_person']); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p class="fw-bold">Description</p>
              <p><?= esc($data['description']); ?></p>
            </div>
          </div>
          <?php $detail_package = model('tourismPackageModel')->detail_package($data['id']);
          $package_day = model('tourismPackageModel')->package_day($data['id']);
          foreach ($package_day as $pd) :
            $dp = model('tourismPackageModel')->detail_package_day($pd['id']); ?>
            <div class="row">
              <div class="col">
                <p class="fw-bold">Activities (Day <?= $pd['day']; ?>)</p>
                <?php $i = 1; ?>
                <?php foreach ($dp as $dd) : ?>
                  <p><?= esc($i) . '. ' . esc($dd['activity']); ?></p>
                  <?php $i++; ?>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
          <div class="row">
            <div class="col">
              <p class="fw-bold">Facility</p>
              <?php $i = 1; ?>
              <?php foreach ($data['f'] as $f) : ?>
                <p><?= esc($i) . '. ' . esc($f); ?></p>
                <?php $i++; ?>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p class="fw-bold">Non Facility</p>
              <?php $i = 1; ?>
              <?php foreach ($data['nf'] as $nf) : ?>
                <p><?= esc($i) . '. ' . esc($nf); ?></p>
                <?php $i++; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>

      <!--Rating and Review Section-->
      <?= $this->include('web/layouts/review'); ?>
    </div>

    <!-- Media -->
    <div class="col-md-6 col-12">
      <!-- Object Location on Map -->
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Google Maps</h5>
        </div>
        <?= $this->include('web/layouts/map-body'); ?>

        <script>
          // initMap();
          map.setZoom(15);
        </script>

        <?php $loop = 0;
        $j = count($detail_package);
        foreach ($detail_package as $dp) {
          $loop++;
          $id_object = $dp['id_object'];
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
          } elseif ('H' == substr($id_object, 0, 1)) {
            $object = model('tourismPackageModel')->history_place($id_object);
          } else {
            $object = model('tourismPackageModel')->study($id_object);
          }
          $lat_now = esc($object['lat']);
          $lng_now = esc($object['lng']);
          if (1 == $loop) {
            $lat_fir = $lat_now;
            $ltd_fir = $lng_now;
          }
          if ($j == $loop) {
            $lat_las = $lat_now;
            $ltd_las = $lng_now;
          } ?>

          <script>
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
            <?php }
            if ($j == $loop) { ?>
              // new01(<?= $lat_fir; ?>, <?= $ltd_fir; ?>, <?= $lat_las; ?>, <?= $ltd_las; ?>);
            <?php } ?>
          </script>
        <?php $lat_bef = $lat_now;
          $lng_bef = $lng_now;
        } ?>

        <!-- Object Media -->
        <?= $this->include('web/layouts/gallery_video'); ?>
      </div>
    </div>

  </div>
  </div>

  </button>
  </div>
  </div>
  </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
  const myModal = document.getElementById('videoModal');
  const videoSrc = document.getElementById('video-play').getAttribute('data-src');

  myModal.addEventListener('shown.bs.modal', () => {
    console.log(videoSrc);
    document.getElementById('video').setAttribute('src', videoSrc);
  });
  myModal.addEventListener('hide.bs.modal', () => {
    document.getElementById('video').setAttribute('src', '');
  });
</script>
<?= $this->endSection() ?>