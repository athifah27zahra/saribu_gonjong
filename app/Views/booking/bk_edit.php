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
                <span aria-hidden="true">&times;</span>
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
                <span aria-hidden="true">&times;</span>
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
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
            }            
            //echo var_dump($booking);
            $status = App\Controllers\Web\MyBooking::_setStatus($booking[0]['status']);
            ?>
            <h6>Detail Booking</h6>
            <form method="post">
                <input type="hidden" name="editbook" value="book" />
            <div class="col table-responsive">
              <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td class="fw-bold">Booking Status</td>
                        <td><?=$status?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                    <div class="form-group date">
                        <label>Booking Date</label>
                        <input type="text" class="form-control" id="datepickerVH" value="<?=$booking[0]['date'];?>" name="book_tanggal">
                    </div>
                        <?php
                        if($data['package']['custom']==1) {
                            ?>
                            <div class="form-group">
                                <label>Jumlah Anggota</label>
                                <input type="number" class="form-control" name="book_anggota" value="<?=$booking[0]['total_member']?>" />
                            </div>
                            <?php
                        } else {
                            ?><input type="hidden" class="form-control" name="book_anggota" value="<?=$booking[0]['total_member']?>" /><?php
                        }
                        ?>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="book_keterangan"><?=$booking[0]['comment']?></textarea>
                    </div>
                        </td>
                    </tr>
                </tbody>
              </table>
                <input type="submit" class="btn btn-primary" name="submitedit" value="Ubah Data Booking" />
                <hr />
            </div>
            </form>
            <form method="post">
                <input type="hidden" name="editpack" value="book" />
                <h6>Detail Package</h6>
                <div class="col table-responsive">
                  <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="fw-bold">ID Package</td>
                            <td><?= esc($data['package']['id']) ?></td>
                        </tr>
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
                      <?php
                      /*
                      if($data['package']['custom']==1) {
                          ?>
                      <tr>
                          <td class="fw-bold">Contact Person</td>
                          <td><input type="text" name="contact_person" value="<?= esc($data['package']['contact_person']); ?>" /></td>
                      </tr>
                      <tr>
                          <td></td>
                          <td><button type="submit" class="btn btn-primary me-1 mb-1">Edit Contact Person</button></td>
                      </tr>
                          <?php
                      } else {
                       * 
                       */
                          ?>
                          <tr>
                            <td class="fw-bold">Contact Person</td>
                            <td><?= esc($data['package']['contact_person']); ?></td>
                          </tr>
                          <?php
                      //}
                      ?>                       
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
                
            </form>
            <?php
            if($data['package']['custom']==1) {
                ?>
            <form method="post">
                <input type="hidden" name="editdetail" value="book" />
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
                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan Detail Package</button>
            </form> 
                <?php
            } else {
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
                <?php
            }
            ?>
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
        } else if ('HP' == value_select.substring(0, 2)) {
            set_value = 'HP';
        } else if ('O' == value_select.substring(0, 1)) {
            set_value = 'TO';
        } else if ('S' == value_select.substring(0, 1)) {
         set_value = 'S';
        } else if ('A' == value_select.substring(0, 1)) {
            set_value = 'A';
        } 
        // else  {
        //     set_value = 'H';
        // }
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

