<?php
$uri = service('uri')->getSegments();
$users = in_array('users', $uri);
?>

<?= $this->extend('dashboard/layouts/main'); ?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="card">
            <div class="card-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="card-title">Manage Tourism Package</h3>
                    </div>
                    <?php if ($category != 'Users'): ?>
                    <div class="col">
                        <a href="<?= current_url(); ?>/new" class="btn btn-primary float-end"><i class="fa-solid fa-plus me-3"></i> New <?= $category; ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">               
                <div class="form-group">
                    <select class="form-control" onchange="window.location='<?=base_url("dashboard/tourismPackage?custom=")?>'+this.value">
                        <option value="0" <?=$custom=='0'?'selected':''?>>By Admin</option>
                        <option value="1" <?=$custom=='1'?'selected':''?>>By User</option>
                    </select>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover dt-head-center" id="table-manage">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name Package</th>
                            <th>Custom Package</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            foreach((array)$data as $dt) {
                                //echo var_dump($dt);
                                $cust = $dt['custom']==0?"Admin":"User";
                                ?>
                            <tr>
                                <td><?=$dt['id']?></td>
                                <td><?=$dt['name']?></td>
                                <td><?=$cust?></td>
                                <td>
                                    <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info" class="btn icon btn-outline-primary mx-1" href="<?=base_url('dashboard/tourismPackage/'.$dt['id'])?>">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                    <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" class="btn icon btn-outline-danger mx-1" onclick="deleteObject('<?= esc($dt['id']); ?>', '<?= esc($dt['name']); ?>',false)">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $(document).ready( function () {
        $('#table-manage').DataTable({
            columnDefs: [
                {
                    targets: ['_all'],
                    className: 'dt-head-center'
                }
            ],
            lengthMenu: [ 5, 10, 20, 50, 100 ]
        });
    } );
</script>
<?= $this->endSection() ?>