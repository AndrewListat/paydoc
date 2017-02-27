<?php

use yii\bootstrap\Html;
/**
 * Created by PhpStorm.
 * User: Listat
 * Date: 27.02.2017
 * Time: 22:46
 */
?>
<div class="row">
    <?php echo Html::submitButton('<img class="left" width="48px" src="/images/filetype_pdf.png" /><p>Счет на оплата<br> без печати</p>', [
        'class'=>'btn btn-default pull-right',
        'style'=>'margin: 5px; border:0',
        'name'=>'add_document',
        'data-toggle'=>'tooltip',
        'value'=>'rah_b',
    ]);?>
    <?php echo Html::submitButton('<img class="left" width="48px" src="/images/filetype_pdf.png" /><p>Акт о передачи<br> права без печати</p>', [
        'class'=>'btn btn-default pull-right',
        'style'=>'margin: 5px; border:0',
        'name'=>'add_document',
        'data-toggle'=>'tooltip',
        'value'=>'act_b',
    ]);?>
    <?php echo Html::submitButton('<img class="left" width="48px" src="/images/filetype_pdf.png" /><p>Договор без печати</p>',  [
        'class'=>'btn btn-default pull-right',
        'style'=>'margin: 5px; border:0',
        'name'=>'add_document',
        'data-toggle'=>'tooltip',
        'value'=>'dohovor_b',
    ]);?>
</div>
<div class="row">
    <?php echo Html::submitButton('<img class="left" width="48px" src="/images/filetype_pdf.png" /><p>Счет на оплату<br> с печатью</p>',  [
        'class'=>'btn btn-default pull-right',
        'style'=>'margin: 5px; border:0',
        'name'=>'add_document',
        'data-toggle'=>'tooltip',
        'value'=>'rah_z',
    ]);?>
    <?php echo Html::submitButton('<img class="left" width="48px" src="/images/filetype_pdf.png" /><p>Акт о передачи<br> права с печать</p>',  [
        'class'=>'btn btn-default pull-right',
        'style'=>'margin: 5px; border:0',
        'name'=>'add_document',
        'data-toggle'=>'tooltip',
        'value'=>'act_z',
    ]);?>
    <?php echo Html::submitButton(' <img class="left" width="48px" src="/images/filetype_pdf.png" /> <p>Договор c печати</p>',  [
        'class'=>'btn btn-default pull-right',
        'style'=>'margin: 5px; border:0;padding:0',
        'name'=>'add_document',
        'data-toggle'=>'tooltip',
        'value'=>'dohovor_z',
    ]);?>
</div>
