<?php
$uri = service('uri')->getSegments();
$edit = in_array('edit', $uri);
?>

<?= $this->extend('web/layouts/main'); ?>

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
<?php
//echo var_dump($package);
?>
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
            <form class="form form-vertical" action="<?=base_url("booking/keranjang/{$data['idpackage']}")?>" method="post">
                <input type="hidden" name="create_custom" value="kirim" />
                <input type="hidden" id="contact_person"name="contact_person" placeholder="Contact Person" value="<?=$package['contact_person']?>">
            <div class="form-body">
                <?php /*
                <div class="form-group mb-4">
                  <label for="contact_person" class="mb-2">Contact Person</label>
                  
                </div>
                 *
                 */
                ?>
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
                <button type="submit" class="btn btn-primary me-1 mb-1">Lanjut</button>
            </div>
            
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
        'S' => 'Study',
        'O' => 'Tourism Object',  
        'A' => 'Tourism Activity',
        'HP' => 'History Place',
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
    } 
    ?>
    id_activity = 0;
    facility_package_id = '';
    <?php 
    foreach ((array)$facility_package as $fp) {
        $php_id = str_replace('<br />', ' ', nl2br($fp['id']));
        $php_facility = str_replace('<br />', ' ', nl2br($fp['name'])); 
        ?>
    facility_package_id = facility_package_id + '<option value="<?= $php_id; ?>"><?= $php_facility; ?></option>';
        <?php        
    } 
    ?>
    id_facility = 0;
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
        } else {
            set_value = 'H';
        }
        $(id_tipe).val(set_value);
    }
    
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
    
        id_object_edit = ''; 
        <?php 
        //echo var_dump($object);
        foreach ((array)$object as $o) {
            $grabid = substr($o['id'],0, 2);
            //echo var_dump($grabid);
            $allowkode = true;
            for ($i = 0; $i <= strlen($grabid)-1; $i++) {
                if(is_numeric($grabid[$i]))  {
                   $allowkode = false;
                }
            }
            if($allowkode==false) {
                $grabid = substr($o['id'],0, 1);
            }
            $phpkod = $arkode[$grabid];
            //$phpkod = '';
            if(isset($o['status'])) {
                if($o['status']=='Homestay') {
                    $php_id = str_replace('<br />', ' ', nl2br($o['id']));
                    $php_name = str_replace('<br />', ' ', nl2br($o['name'])); 
                    ?>
        if (param_id_object == '<?= $php_id; ?>') {
            selected = ' selected';
        } else {
            selected = '';
        }
        id_object_edit = id_object_edit + '<option value="<?= $php_id; ?>"' + selected + '><?= "($phpkod) ".$php_name; ?></option>';
                    <?php
                }   
            } else {
                $php_id = str_replace('<br />', ' ', nl2br($o['id']));
                $php_name = str_replace('<br />', ' ', nl2br($o['name']));
                ?>
        if (param_id_object == '<?= $php_id; ?>') {
          selected = ' selected';
        } else {
          selected = '';
        }
        id_object_edit = id_object_edit + '<option value="<?= $php_id; ?>"' + selected + '><?= "($phpkod) ".$php_name; ?></option>';
                <?php
            }
        }
        ?>
        value_id_object = id_object_edit;
        if (null == param_description) {
            value_description = '';
        } else {
            value_description = param_description;
        }
        isi_detail = '<div id="divd'+id_detail+'" class="mt-4">'+
                    '<a href="#btn_add_activity" class="hapusDetail mt-4" data-id="'+id_detail+'"><i class="fa fa-remove"></i></a><input type="hidden" value="' + id_detail + '" name="d_id_detail' + id + '[]"><div class="row mt-1"><div class="col-12"><textarea class="form-control mt-2" placeholder="Description" name="d_description' + id + '['+id_detail+']">' + value_description + '</textarea></div></div><div class="row mt-1"><div class="col-6"><input type="number" class="form-control" placeholder="Activity" name="d_activity' + id + '['+id_detail+']"' + value_activity + '></div><input type="hidden" name="d_activity_type' + id + '['+id_detail+']" id="d_activity_type_' + id + '_' + id_detail + '"' + value_activity_type + '><div class="col-6"><select onchange="ganti_tipe(this.value, \'#d_activity_type_' + id + '_' + id_detail + '\');" class="form-control" name="d_id_object' + id + '['+id_detail+']">' + value_id_object + '</select></div></div></div>';
        $('#div_detail' + id).append(isi_detail);
    }
    
    function add_facility(param_facility_package_id = null, param_status = null) {
        id_facility++;
        non_facility = '';
    
        facility_package_id_edit = '';
        selname = '';
        <?php 
        foreach ($facility_package as $fp) {
            $php_id = str_replace('<br />', ' ', nl2br($fp['id']));
            $php_facility = str_replace('<br />', ' ', nl2br($fp['name'])); 
            ?>
            if (param_facility_package_id == '<?= $php_id; ?>') {
              selected = ' selected';
              selname = '<?=$php_facility?>';
              console.log(selname);
            } else {
              selected = '';
            }
            facility_package_id_edit = facility_package_id_edit + '<option value="<?= $php_id; ?>"' + selected + '><?= $php_facility; ?></option>';
            <?php 
        } 
        ?>
        value_facility_package_id = facility_package_id_edit;
        if ('0' == param_status) {
          non_facility = ' selected';
        }
        isi_facility = '<div id="fac'+id_facility+'" class="mt-4"><a href="#btn_add_facility" class="hapusFacility mt-4" data-id="'+id_facility+'"><i class="fa fa-remove"></i></a><input type="hidden" value="' + id_facility + '" name="f_id_facility[]"><input type="hidden" value="'+selname+'" name="f_name_facility[' + id_facility + ']"><div class="row mt-1"><div class="col-6"><select class="form-control" name="f_facility_package_id[' + id_facility + ']" onchange="changeService(this,\'f_name_facility[' + id_facility + ']\');">' + value_facility_package_id + '</select></div><div class="col-6"><select class="form-control" name="f_status[' + id_facility + ']"><option value="1">Service</option><option value="0"' + non_facility + '>Non Service</option></select></div></div></div>';
    $('#div_facility').append(isi_facility);
    }
    
    function changeService(elem,target) {
        var textt = elem[elem.selectedIndex].innerHTML;
        $("[name='"+target+"']").val(textt);
        //console.log(elem.selectedIndex);
        //console.log(elem[elem.selectedIndex].innerHTML)
    }
  
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
    
    $("#btn_add_facility").click(function() {
        add_facility();
    });
  
    $(document).on("click",".hapusFacility",function() {
        var idact = $(this).attr("data-id");
        console.log(idact);
        $("#fac"+idact).remove();
    });
    
    <?php
    $id_activity = 0;
    foreach ($data['package_day'] as $pd) {
      $id_activity++;
      ?>
      add_activity(<?= $id_activity; ?>, <?= $pd['day']; ?>, '<?= $pd['description']; ?>');
      <?php 
        if(isset($data['package_det'][$pd['day']])) {
            foreach ($data['package_det'][$pd['day']] as $dd) { 
                ?>
                add_detail(<?= $id_activity; ?>, '<?= $dd['activity']; ?>', '<?= $dd['activity_type']; ?>', '<?= $dd['id_object']; ?>', '<?= $dd['description']; ?>');
            <?php 

            }
        }
    } 
    
    foreach((array)$data['service'] as $dsv) {
        ?>
        add_facility('<?= $dsv['service_package_id']; ?>', '<?= $dsv['service_package_stat']; ?>');
        <?php
    }
    foreach((array)$data['servnon'] as $dsv) {
        ?>
        add_facility('<?= $dsv['service_package_id']; ?>', '<?= $dsv['service_package_stat']; ?>');
        <?php
    }
    ?>
</script>
<?= $this->endSection() ?>
