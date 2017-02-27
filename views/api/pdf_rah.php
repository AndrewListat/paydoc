<?php
/**
 * Created by PhpStorm.
 * User: Listat
 * Date: 21.02.2017
 * Time: 15:55
 */?>
<div style="font-size: 8pt; padding: 20px">
    <div class="row" style="text-align: center">
        Внимание! Оплата данного счета означает согласие с условиями поставки товара. Уведомление об оплате
        обязательно, в противном случае не гарантируется наличие товара на складе. Товар отпускается по факту
        прихода денег на р/с Поставщика, самовывозом, при наличии доверенности и паспорта.
    </div>
    <br>
    <div class="row">
        <table border="1" cellspacing="0" cellpadding="0" style="font-size: 9pt; width: 100%">
            <tbody>
            <tr>
                <td width="319" colspan="2" rowspan="2" valign="top">
                </td>
                <td width="66" valign="top">
                    БИК
                </td>
                <td width="253" rowspan="2" valign="top">
                </td>
            </tr>
            <tr>
                <td width="66" valign="top">
                    Сч. №
                </td>
            </tr>
            <tr>
                <td width="159" valign="top">
                </td>
                <td width="160" valign="top">
                </td>
                <td width="66" rowspan="2" valign="top">
                    Сч. №
                </td>
                <td width="253" rowspan="2" valign="top">
                </td>
            </tr>
            <tr>
                <td width="319" colspan="2" valign="top">
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <div class="row" style=" border-bottom: 1px solid black; font-size: 10pt;">
        <strong>ТекстЗаголовка</strong>
    </div>
    <br>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4" style="">
            Поставщик:
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6" style="">
            <strong>ПредставлениеПоставщика</strong>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4" style="">
            Покупатель:
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6" style="">
            <strong>ПредставлениеПолучателя</strong>
        </div>
    </div>
    <br>
    <div class="row">
        <table border="1" cellspacing="0" cellpadding="0" width="100%">
            <tbody>
            <tr>
                <td width="26" valign="top">
                    №
                </td>
                <td width="274" valign="top">
                    Товар
                </td>
                <td width="66" valign="top">
                    Кол-во
                </td>
                <td width="59" valign="top">
                    Ед.
                </td>
                <td width="106" valign="top">
                    Цена
                </td>
                <td width="106" valign="top">
                    Сумма
                </td>
            </tr>
            <?php
            $docItems = \app\modules\ls_admin\models\DocumentItem::findAll(['order_id'=>$document->id]);
            $k = 0;
            $count_prod = 0;
            foreach ($docItems as $item){
            $k++;
            $count_prod += $item->quantity;
            ?>
            <tr>
                <td width="26" valign="top">
                    <?=$k?>
                </td>
                <td width="274" valign="top">
                    <?=$item->product['name']?>
                </td>
                <td width="66" valign="top">
                    <?=$item->quantity?>
                </td>
                <td width="59" valign="top">
                    шт
                </td>
                <td width="106" valign="top">
                    <?=$item->price?>
                </td>
                <td width="106" valign="top">
                    <?=$item->price*$item->quantity?>
                </td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
    <div class="row" style="border-bottom: 2px solid black;padding-top: 5px"></div>

    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8" style="">
            <br>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1" style="">
            <strong>Итого:</strong> <?=$document->total?>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1" style="">
            <strong>Всего</strong> <?=$document->total?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8" style="">
            <br>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1" style="">
            <strong>НДС</strong>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1" style="">
            <strong>ВсегоНДС</strong>
        </div>
    </div>

    <div class="row" style="border-bottom: 2px solid black;">
        <?php
        $num2str = new \app\commands\Num2str();
        $ruble = array(1 => 'рубль', 2 => 'рубля', 5 => 'рублей');
        $sum = intval($document->total);
        echo 'Всего отпущено  на сумму: '
            .  $num2str->written_number($sum) . ' ' . $ruble[$num2str->num_125($sum)] . ' 00 коп.';
        ?>
    </div>

    <div class="row" style="margin: 0; padding: 0">
        <div class="col-xs-2 col-sm-2 col-md-2" style="margin: 0; padding: 0"><strong>Руководитель</strong></div>
        <div class="col-xs-3 col-sm-3 col-md-3" style="border-bottom: 1px solid black;margin: 0; padding: 0"><br></div>
        <div class="col-xs-2 col-sm-2 col-md-2" style="margin: 0; margin-left: 5px; padding: 0"><strong>Бухгалтер</strong></div>
        <div class="col-xs-4 col-sm-4 col-md-4" style="border-bottom: 1px solid black;margin: 0; padding: 0"><br></div>
    </div>
    <div class="row" style="border-bottom: 2px solid black; padding-top: 5px;padding-bottom: 5px;"></div>
    <div class="row" style="margin: 0; padding: 0">
        <div class="col-xs-2 col-sm-2 col-md-2" style="margin: 0; padding: 0"><strong>Исполнитель</strong></div>
        <div class="col-xs-3 col-sm-3 col-md-3" style="border-bottom: 1px solid black;margin: 0; padding: 0"><br></div>
        <div class="col-xs-2 col-sm-2 col-md-2" style="margin: 0; margin-left: 5px; padding: 0"><strong>Заказчик</strong></div>
        <div class="col-xs-4 col-sm-4 col-md-4" style="border-bottom: 1px solid black;margin: 0; padding: 0"><br></div>
    </div>

</div>
