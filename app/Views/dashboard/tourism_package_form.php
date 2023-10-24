<?php
$uri = service('uri')->getSegments();
$edit = in_array('edit', $uri);
?>

<?= $this->extend('dashboard/layouts/main'); ?>

<?= $this->section('styles') ?>
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/filepond-plugin-media-preview@1.0.11/dist/filepond-plugin-media-preview.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/pages/form-element-select.css'); ?>">
<style>
  .filepond--root {
    width: 100%;
  }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="row">
    <script>
      currentUrl = '<?= current_url(); ?>';
    </script>

    <!-- Object Detail Information -->
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title text-center"><?= $title; ?></h4>
        </div>
        <div class="card-body">
          <form class="form form-vertical" action="<?= ($edit) ? base_url('dashboard/tourismPackage/update') . '/' . $data['id'] : base_url('dashboard/tourismPackage'); ?>" method="post" enctype="multipart/form-data">
            <div class="form-body">
              <div class="form-group mb-4">
                <label for="name" class="mb-2">Tourism Package Name</label>
                <input type="text" id="name" class="form-control" name="name" placeholder="Tourism Package Name" value="<?= ($edit) ? $data['name'] : old('name'); ?>" required>
              </div>
              <div class="form-group mb-4">
                <label for="price" class="mb-2">Price</label>
                <div class="input-group">
                  <span class="input-group-text">Rp </span>
                  <input type="number" id="price" class="form-control" name="price" placeholder="Price" aria-label="Price" aria-describedby="price" value="<?= ($edit) ? $data['price'] : old('price'); ?>">
                </div>
              </div>
              <div class="form-group mb-4">
                <label for="capacity" class="mb-2">Capacity</label>
                <div class="input-group">
                  <input type="number" id="capacity" class="form-control" name="capacity" placeholder="Capacity" aria-label="Capacity" aria-describedby="capacity" value="<?= ($edit) ? $data['capacity'] : old('capacity'); ?>">
                </div>
              </div>
              <div class="form-group mb-4">
                <label for="contact_person" class="mb-2">Contact Person</label>
                <input type="tel" id="contact_person" class="form-control" name="contact_person" placeholder="Contact Person" value="<?= ($edit) ? $data['contact_person'] : old('contact_person'); ?>">
              </div>
              <div class="form-group mb-4">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?= ($edit) ? $data['description'] : old('description'); ?></textarea>
              </div>
              <input type="hidden" id="custom" name="custom" placeholder="Custom" value="0">
              <div class="form-group mb-4">
                <label class="form-label">Activity</label>
                <br />
                <button type="button" class="btn btn-primary" id="btn_add_activity">Add Activity</button>
                <div id="div_activity"></div>
              </div>
              <div class="form-group mb-4">
                <label class="form-label">Service</label>
                <br />
                <button type="button" class="btn btn-primary" id="btn_add_facility">Add Service</button>
                <div id="div_facility"></div>
              </div>
              <div class="form-group mb-4">
                <label for="gallery" class="form-label">Gallery</label>
                <input class="form-control" accept="image/*" type="file" name="gallery[]" id="gallery" multiple>
              </div>
              <div class="form-group mb-4">
                <label for="video" class="form-label">Video</label>
                <input class="form-control" accept="video/*" type="file" name="video" id="video">
              </div>
              <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
              <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</section>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<script>
  id_object = '';
  <?php 
  $arkode = [
    'R' => 'Rumah Gadang',
    'SP' => 'Souvenir Place',
    'WP' => 'Worship Place',
    'UP' => 'UMKM Place',
    'HP' => 'History Place',
    'S' => 'Study',
    'O' => 'Tourism Object',
    'A' => 'Tourism Activity'  
  ];
  foreach ($object as $o) {
          if(isset($o['status'])) {
            if($o['status']=='Homestay') {
              $php_id = str_replace('<br />', ' ', nl2br($o['id']));
              $php_name = str_replace('<br />', ' ', nl2br($o['name'])); 
              ?>
            id_object = id_object + '<option value="<?= $php_id; ?>"><?= $php_name; ?></option>';
              <?php
            }
          } else {
              $php_id = str_replace('<br />', ' ', nl2br($o['id']));
              $php_name = str_replace('<br />', ' ', nl2br($o['name'])); 
              ?>
            id_object = id_object + '<option value="<?= $php_id; ?>"><?= $php_name; ?></option>';
              <?php
          }
        } ?>

  function add_detail(id, param_activity = null, param_activity_type = null, param_id_object = null, param_description = null) {
    id_detail++;
    if (null == param_activity) {
      value_activity = '';
    } else {
      value_activity = ' value="' + param_activity + '"';
    }
    if (null == param_activity_type) {
      value_activity_type = ' value="Rumah Gadang"';
    } else {
      value_activity_type = ' value="' + param_activity_type + '"';
    }
    <?php if ($edit) { ?>
      id_object_edit = '';
      <?php 
      //echo var_dump($object);
      foreach ($object as $o) {
        if(isset($o['status'])) {
          if($o['status']=='Homestay') {
            $php_id = str_replace('<br />', ' ', nl2br($o['id']));
            $php_name = str_replace('<br />', ' ', nl2br($o['name'])); ?>
            if (param_id_object == '<?= $php_id; ?>') {
              selected = ' selected';
            } else {
              selected = '';
            }
            id_object_edit = id_object_edit + '<option value="<?= $php_id; ?>"' + selected + '><?= $php_name; ?></option>';
            <?php
          }
        } else {
          $php_id = str_replace('<br />', ' ', nl2br($o['id']));
          $php_name = str_replace('<br />', ' ', nl2br($o['name'])); ?>
          if (param_id_object == '<?= $php_id; ?>') {
            selected = ' selected';
          } else {
            selected = '';
          }
          id_object_edit = id_object_edit + '<option value="<?= $php_id; ?>"' + selected + '><?= $php_name; ?></option>';
          <?php
        }
      } ?>
      value_id_object = id_object_edit;
    <?php } else { ?>
      value_id_object = id_object;
    <?php } ?>
    if (null == param_description) {
      value_description = '';
    } else {
      value_description = param_description;
    }
    isi_detail = '<div id="divd'+id_detail+'" class="mt-4"><a href="#btn_add_activity" class="hapusDetail mt-4" data-id="'+id_detail+'"><i class="fa fa-remove"></i></a><input type="hidden" value="' + id_detail + '" name="d_id_detail' + id + '[]"><div class="row mt-1"><div class="col-12"><textarea class="form-control mt-2" placeholder="Description" name="d_description' + id + '['+id_detail+']">' + value_description + '</textarea></div></div><div class="row mt-1"><div class="col-6"><input type="number" class="form-control" placeholder="Activity" name="d_activity' + id + '['+id_detail+']"' + value_activity + '></div><input type="hidden" name="d_activity_type' + id + '['+id_detail+']" id="d_activity_type_' + id + '_' + id_detail + '"' + value_activity_type + '><div class="col-6"><select onchange="ganti_tipe(this.value, \'#d_activity_type_' + id + '_' + id_detail + '\');" class="form-control" name="d_id_object' + id + '['+id_detail+']">' + value_id_object + '</select></div></div></div>';
    $('#div_detail' + id).append(isi_detail);
  }

  function ganti_tipe(value_select, id_tipe) {
    if ('R' == value_select.substring(0, 1)) {
      set_value = 'RG';
    } else if ('WP' == value_select.substring(0, 2)) {
      set_value = 'WP';
    } else if ('SP' == value_select.substring(0, 2)) {
      set_value = 'SP';
    } else if ('UP' == value_select.substring(0, 2)) {
      set_value = 'UP';
    } else if ('O' == value_select.substring(0, 1)) {
      set_value = 'TO';
    } else if ('S' == value_select.substring(0, 1)) {
      set_value = 'S';
    } else if ('A' == value_select.substring(0, 1)) {
      set_value = 'A';
    } else  {
      set_value = 'HP';
    }
    $(id_tipe).val(set_value);
  }
  
  
  id_detail = 0;
  function add_activity(param_id = null, param_day = null, param_description = null) {
    id_activity++;
    value_id = id_activity;
    if (null == param_day) {
      value_day = '';
    } else {
      value_day = ' value="' + param_day + '"';
    }
    if (null == param_description) {
      value_description = '';
    } else {
      value_description = param_description;
    }
    isi_activity = '<div id="act'+id_activity+'" class="mt-4"><a href="#btn_add_activity" class="hapusActivity mt-4" data-id="'+id_activity+'"><i class="fa fa-remove"></i></a><input type="hidden" value="' + value_id + '" name="a_id_activity[]"><input type="number" class="form-control mt-1" placeholder="Day" name="a_day'+id_activity+'[]"' + value_day + '><textarea class="form-control mt-2" placeholder="Description" name="a_description'+id_activity+'[]">' + value_description + '</textarea><button type="button" class="btn btn-sm btn-info mt-2" onclick="add_detail(' + id_activity + ');">Add Detail</button><div id="div_detail' + id_activity + '" class="mt-2 ms-5"></div></div>';
    $('#div_activity').append(isi_activity);
    console.log(id_activity);
  }

  id_activity = 0;
  $("#btn_add_activity").click(function() {
    add_activity();
  });
  $(document).on("click",".hapusActivity",function() {
     var idact = $(this).attr("data-id");
     console.log(idact);
     $("#act"+idact).remove();
  });
  $(document).on("click",".hapusDetail",function() {
     var idact = $(this).attr("data-id");
     console.log(idact);
     $("#divd"+idact).remove();
  });

  facility_package_id = '';
  <?php foreach ($facility_package as $fp) {
    $php_id = str_replace('<br />', ' ', nl2br($fp['id']));
    $php_facility = str_replace('<br />', ' ', nl2br($fp['name'])); ?>
    facility_package_id = facility_package_id + '<option value="<?= $php_id; ?>"><?= $php_facility; ?></option>';
  <?php } ?>

  function add_facility(param_facility_package_id = null, param_status = null) {
    id_facility++;
    non_facility = '';
    <?php if ($edit) { ?>
      facility_package_id_edit = '';
      <?php foreach ($facility_package as $fp) {
        $php_id = str_replace('<br />', ' ', nl2br($fp['id']));
        $php_facility = str_replace('<br />', ' ', nl2br($fp['name'])); ?>
        if (param_facility_package_id == '<?= $php_id; ?>') {
          selected = ' selected';
        } else {
          selected = '';
        }
        facility_package_id_edit = facility_package_id_edit + '<option value="<?= $php_id; ?>"' + selected + '><?= $php_facility; ?></option>';
      <?php } ?>
      value_facility_package_id = facility_package_id_edit;
      if ('0' == param_status) {
        non_facility = ' selected';
      }
    <?php } else { ?>
      value_facility_package_id = facility_package_id;
    <?php } ?>
    isi_facility = '<div id="fac'+id_facility+'" class="mt-4"><a href="#btn_add_facility" class="hapusFacility mt-4" data-id="'+id_facility+'"><i class="fa fa-remove"></i></a><input type="hidden" value="' + id_facility + '" name="f_id_facility[]"><div class="row mt-1"><div class="col-6"><select class="form-control" name="f_facility_package_id[' + id_facility + ']">' + value_facility_package_id + '</select></div><div class="col-6"><select class="form-control" name="f_status[' + id_facility + ']"><option value="1">Service</option><option value="0"' + non_facility + '>Non Service</option></select></div></div></div>';
    $('#div_facility').append(isi_facility);
  }

  id_facility = 0;
  $("#btn_add_facility").click(function() {
    add_facility();
  });
  
  $(document).on("click",".hapusFacility",function() {
     var idact = $(this).attr("data-id");
     console.log(idact);
     $("#fac"+idact).remove();
  });

    
  <?php if ($edit) {
    $id_activity = 0;
    $detail_package = model('tourismPackageModel')->detail_package($data['id']);
    $package_day = model('tourismPackageModel')->package_day($data['id']);
    foreach ($package_day as $pd) {
      $id_activity++;
      $dp = model('tourismPackageModel')->detail_package_day($pd['day'], $pd['tourism_package_id']); ?>
      add_activity(<?= $id_activity; ?>, <?= $pd['day']; ?>, '<?= $pd['description']; ?>');
      <?php foreach ($dp as $dd) { ?>
        add_detail(<?= $id_activity; ?>, '<?= $dd['activity']; ?>', '<?= $dd['activity_type']; ?>', '<?= $dd['id_object']; ?>', '<?= $dd['description']; ?>');
      <?php } ?>
    <?php } ?>

    <?php foreach ($data['f'] as $f) { ?>
      add_facility('<?= $f['id']; ?>', '<?= $f['status']; ?>');
    <?php } ?>
  <?php } ?>
</script>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://cdn.jsdelivr.net/npm/filepond-plugin-media-preview@1.0.11/dist/filepond-plugin-media-preview.min.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="<?= base_url('assets/js/extensions/form-element-select.js'); ?>"></script>
<script>
  getFacility();
</script>
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
<script>
  FilePond.registerPlugin(
    FilePondPluginFileValidateSize,
    FilePondPluginFileValidateType,
    FilePondPluginImageExifOrientation,
    FilePondPluginImagePreview,
    FilePondPluginImageResize,
    FilePondPluginMediaPreview,
  );

  // Get a reference to the file input element
  const photo = document.querySelector('input[id="gallery"]');
  const video = document.querySelector('input[id="video"]');

  // Create a FilePond instance
  const pond = FilePond.create(photo, {
    maxFileSize: '1920MB',
    maxTotalFileSize: '1920MB',
    imageResizeTargetHeight: 720,
    imageResizeUpscale: false,
    credits: false,
  });
  const vidPond = FilePond.create(video, {
    maxFileSize: '1920MB',
    maxTotalFileSize: '1920MB',
    credits: false,
  })

  <?php if ($edit && count($data['gallery']) > 0) : ?>
    pond.addFiles(
      <?php foreach ($data['gallery'] as $gallery) : ?> `<?= base_url('media/photos/' . $gallery); ?>`,
      <?php endforeach; ?>
    );
  <?php endif; ?>
  pond.setOptions({
    server: {
      timeout: 3600000,
      process: {
        url: '/upload/photo',
        onload: (response) => {
          console.log("processed:", response);
          return response
        },
        onerror: (response) => {
          console.log("error:", response);
          return response
        },
      },
      revert: {
        url: '/upload/photo',
        onload: (response) => {
          console.log("reverted:", response);
          return response
        },
        onerror: (response) => {
          console.log("error:", response);
          return response
        },
      },
    }
  });

  <?php if ($edit && $data['video_url'] != null) : ?>
    vidPond.addFile(`<?= base_url('media/videos/' . $data['video_url']); ?>`)
  <?php endif; ?>
  vidPond.setOptions({
    server: {
      timeout: 86400000,
      process: {
        url: '/upload/video',
        onload: (response) => {
          console.log("processed:", response);
          return response
        },
        onerror: (response) => {
          console.log("error:", response);
          return response
        },
      },
      revert: {
        url: '/upload/video',
        onload: (response) => {
          console.log("reverted:", response);
          return response
        },
        onerror: (response) => {
          console.log("error:", response);
          return response
        },
      },
    }
  });
</script>
<?= $this->endSection() ?>