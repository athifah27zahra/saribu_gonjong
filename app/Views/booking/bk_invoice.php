<?= $this->extend('web/layouts/cetak'); ?>

<?= $this->section('content') ?>

<?php
if(isset($booking[0]['status']) && $booking[0]['status']>1) {
    ?>
<button onclick="window.print();" class="btn_print"><i class="fa fa-print"></i> Print Now</button>
<div class="inv-header" style="background-color: #C5E0B3;">
    <table>
        <tr>
            <th style="text-align: left" width="55%">
                BILL TO
            </th>
            <th style="text-align: right">
                Booking Date
            </th>
            <td style="text-align: right">
                <?=isset($booking[0]['date'])?date("j F Y",strtotime($booking[0]['date'])):'-';?>
            </td>
        </tr>
        <tr>
            <td><?=isset($booking[0]['user_name'])?$booking[0]['user_name']:''?></td>
            <th style="text-align: right">Booking Status</th>
            <td style="text-align: right">
                <?php
                echo isset($booking[0]['status'])?App\Controllers\Web\MyBooking::_setStatus($booking[0]['status']):'-';
                ?>
            </td>
        </tr>
    </table>
</div>

<div class="inv-detail">
    <div class="a">
        <table>
            <tr>
                <th style="border-top: #000 solid 1px">
                    Package Name/ID
                </th>
                <th style="border-top: #000 solid 1px">
                    Itenerary
                </th>
                <th style="border-top: #000 solid 1px">
                    Capacity
                </th>
                <th style="border-top: #000 solid 1px">
                    Price
                </th>
            </tr>
            <tr>
                <td>
                    <?php
                    echo isset($data['package']['name'])?$data['package']['name']:'-';
                    echo " / ";
                    echo isset($data['package']['id'])?$data['package']['id']:'-';
                    ?>
                </td>
                <td style="text-align: left">
                    <?php
                        foreach((array)$data['package_day'] as $pd) {
                            ?>

                            Day <?= $pd['day'] ?> :<br />
                                <?php
                                $i = 1;
                                if(isset($data['package_det'][$pd['day']])) {
                                    foreach ((array)$data['package_det'][$pd['day']] as $dd) : 
                                        ?>
                                <?= esc($i) . '. ' . esc($dd['description']); ?><br />
                                        <?php
                                        $i++;
                                    endforeach; 
                                }
                                ?>
                            <br />
                            <?php
                        }
                    ?>
                </td>
                <td>
                    <?=isset($data['package']['capacity'])?esc($data['package']['capacity']):'';?> People
                </td>
                <td>
                    <?= isset($data['package']['price'])?'Rp ' . number_format(esc($data['package']['price']), 0, ',', '.'): 0; ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="tb">
        <table>
            <tr>
                <td width="50%" valign="top">
                    <b>Service</b><br />
                    <?php $i = 1; ?>
                    <?php foreach ($data['service'] as $f) : ?>
                      <?= esc($i) . '. ' . esc($f['service_package_name']); ?><br />
                      <?php $i++; ?>
                    <?php endforeach; ?>
                </td>
                <td>
                    <b>Non Service</b><br />
                    <?php $i = 1; ?>
                    <?php foreach ($data['servnon'] as $nf) : ?>
                      <?= esc($i) . '. ' . esc($nf['service_package_name']); ?><br />
                      <?php $i++; ?>
                    <?php endforeach; ?>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="inv-footer">
    <table width="100%">
        <tr>
            <td style="text-align: left" width:60%>
                Payment Instruction<br />
BNI 12345678 a.n Taufik Nofriandi
            </td>
            <td>
                <div class="amount">
                    Amount Due <span style="font-size: 22px;font-weight: bold"><?= isset($data['package']['price'])?'Rp ' . number_format(esc($data['package']['price']), 0, ',', '.'): 0; ?></span>
                </div>
            </td>
        </tr>
    </table>
    <p style="margin-top: 40px;">NOTE: The costumers agrees to the services and conditions described in this document.</p>
</div>
    
<?php
} else {
    ?><p>You can't access this page</p><?php
}
?>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    
</script>
<?= $this->endSection() ?>