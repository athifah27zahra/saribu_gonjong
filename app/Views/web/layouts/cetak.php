<!doctype html>
<?php $uri = service('uri')->getSegments(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title); ?> - Desa Wisata Saribu Gonjong</title>
    <link rel="shortcut icon" href="<?= base_url('media/icon/favicon.svg'); ?>" type="image/x-icon">
     <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('css/cetak.css'); ?>">
    <script src="https://kit.fontawesome.com/de7d18ea4d.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <div class="header">
                    <img style="flex-grow: 1" src="<?= base_url('media/photos/sarugo.png'); ?>" class="logo" />
                    <div style="flex-grow: 4" class="">
                        <span class="headtext b" style="font-size: 20px">INVOICE</span>
                        <span class="headtext b" style="font-size: 16px">DESA WISATA SARIBU GONJONG (SARUGO)</span>
                        <span class="headtext">Nagari Koto Tinggi, Kec. Gunuang Omeh</span>
                        <span class="headtext">Kab. 50 Kota, Sumatra Barat 26256</span>
                        <span class="headtext">0821-7024-1041</span>
                        <span class="headtext">sarugokampuangwisata@gmail.com</span>
                    </div>
                </div>
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
    
    <!-- Custom JS -->
    <?= $this->renderSection('javascript') ?>
</body>
</html>