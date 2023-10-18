<?= $this->extend('web/layouts/main'); ?>

<?= $this->section('content') ?>
    
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title">Visit History</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-12 table-responsive">
                    <table class="table table-hover mb-0 table-lg" id="table-manage">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Object</th>
                            <th>Rating</th>
                            <th>Review</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $num = 1;
                        foreach((array)$visit as $vis) {
                            ?>
                            <tr>
                                <td class="text-center"><?=$num++?></td>
                                <td class="text-center"><?=$vis['date_visit']?></td>
                                <td class="text-center"><?=$vis['rumah_gadang_name']?></td>
                                <td class="text-center">
                                    <?php
                                    for($i=1;$i<=$vis['rating'];$i++) {
                                        ?><i class="fa-solid fa-star fs-4 star-checked"></i><?php
                                    }
                                    ?>
                                </td>
                                <td class="  dt-head-center"><?=$vis['review']?></td>
                            </tr>
                            <?php                            
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>