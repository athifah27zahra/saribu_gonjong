<?= $this->extend('web/layouts/main'); ?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="card">
            <div class="card-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="card-title">My Booking</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php
                if(session()->getFlashData('success')!=null){
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashData('success') ?>
                  </button>
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
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $idn = 1;
                            foreach((array)$data as $dt) {
                                $has = App\Controllers\Web\MyBooking::_setStatus($dt['status']);
                                ?>
                            <tr>
                                <td><?=$idn?></td>
                                <td><?=$dt['package_name']?></td>
                                <td><?=$dt['purchase_date']?></td>
                                <td><?=$dt['date']?></td>
                                <td><?=$dt['total_member']?></td>
                                <td><?=$has?></td>
                                <td><?=$dt['comment']?></td>
                                <td>
                                    <a data-bs-toggle="tooltip" target="_blank" data-bs-placement="bottom" title="" class="btn icon btn-outline-primary mx-1" href="<?=base_url('booking/detail/'.$dt['tourism_package_id'].'/'.$dt['date'])?>" data-bs-original-title="More Info">
                                    <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <?php
                                    if($dt['status']==2) {
                                        ?>
                                    <a data-bs-toggle="tooltip" target="_blank" data-bs-placement="bottom" title="" class="btn icon btn-outline-primary mx-1" href="<?=base_url('booking/invoice/'.$dt['tourism_package_id'].'/'.$dt['date'])?>" data-bs-original-title="Cetak Invoice">
                                        
                                    <i class="fa-solid fa-print"></i>
                                    </a>
                                        <?php
                                    }
                                    ?>
                                    </a>
                                    <a data-bs-toggle="tooltip" target="_blank" data-bs-placement="bottom" title="" class="btn icon btn-outline-danger mx-1" href="<?=base_url('booking/delete/'.$dt['tourism_package_id'].'/'.$dt['date'])?>" data-bs-original-title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                                <?php
                                $idn++;
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