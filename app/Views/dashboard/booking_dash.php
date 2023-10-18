<?= $this->extend('dashboard/layouts/main'); ?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="card">
            <div class="card-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="card-title"><?=$titlehead?></h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table table-hover dt-head-center" id="table-manage">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Package Name</th>
                            <th>Purchase Date</th>
                            <th>Booking Date</th>
                            <th>Number of People</th>
                            <th>Status</th>
                            <th>Comment</th>
                            <th>Custom Package</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        <?php
                        $idn = 1;
                        foreach((array)$data as $dt) {
                            $custom = "Tidak";
                            if($dt['custom']==1) {
                                $custom = "Ya";
                            }
                            $status = App\Controllers\Web\MyBooking::_setStatus($dt['status']);
                            ?>
                            <tr>
                                <td><?=$idn++?></td>
                                <td><?=$dt['package_name']?> (<?=$dt['package_id']?>)</td>
                                <td><?=$dt['purchase_date']?></td>
                                <td><?=$dt['date']?></td>
                                <td><?=$dt['total_member']?></td>
                                <td><?=$status?></td>
                                <td><?=$dt['comment']?></td>
                                <td><?=$custom?></td>
                                <td><?=$dt['phone']?></td>
                                <td>
                                    <a data-bs-toggle="tooltip" target="_blank" data-bs-placement="bottom" title="" class="btn icon btn-outline-primary mx-1" href="<?=base_url('dashboard/bookingDetail/'.$dt['tourism_package_id'].'/'.$dt['date']."/".$dt['users_id'])?>" data-bs-original-title="More Info">
                                    <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a data-bs-toggle="tooltip" target="_blank" data-bs-placement="bottom" title="" class="btn icon btn-outline-danger mx-1" onclick="deleteBooking('<?=$dt['package_id']?>','<?=$dt['date']?>','<?=$dt['users_id']?>','<?=$dt['package_name']?> (<?=$dt['package_id']?>) - <?=$dt['date']?> ')" data-bs-original-title="Hapus">
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