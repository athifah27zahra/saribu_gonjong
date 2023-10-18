<?= $this->extend('web/layouts/main'); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header mb-4">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="card-title"><?= $category; ?></h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover dt-head-center" id="table-manage">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Package Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php if (isset($data)) : ?>
                            <?php $i = 1; ?>
                            <?php foreach ($data as $item) : ?>
                                <tr>
                                    <td><?= esc($i); ?></td>
                                    <td><?= esc($item['id']); ?></td>
                                    <td class="fw-bold"><?= esc($item['name']); ?></td>
                                    <td><a data-bs-toggle="tooltip" target="_blank" data-bs-placement="bottom" title="More Info" class="btn icon btn-outline-primary mx-1" href="<?= base_url('web/tourismPackage/'); ?>/<?= esc($item['id']); ?>">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </a>
                                    </td>
                                    </td>
                                    <?php $i++ ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table-manage').DataTable({
            columnDefs: [{
                targets: ['_all'],
                className: 'dt-head-center'
            }],
            lengthMenu: [5, 10, 20, 50, 100],
            order: []
        });
    });
</script>
<?= $this->endSection() ?>