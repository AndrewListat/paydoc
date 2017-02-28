<?php
/**
 * Created by PhpStorm.
 * User: Listat
 * Date: 21.02.2017
 * Time: 15:55
 */?>
<div style="font-size: 8pt;">
    <div class="row">
        <div style="text-align: right; width: 20%; float: left; padding-right: 5px">
            Лицензиар
        </div>
        <div style="border-bottom: 1px solid black;width: 77%; float: left;">
            <?=$document->company['name']?>, ИНН <?=$document->company['INN']?>, <?=$document->company['mail_address']?>, тел.: <?=$document->company['tel']?>, р/с <?=$document->company['payment_account']?>, в банке <?=$document->company->bank['name']?>, БИК <?=$document->company['bik']?>, к/с <?=$document->company->bank['ks']?>
        </div>
    </div>
    <div class="row">
        <div style="text-align: right; width: 20%; float: left; padding-right: 5px">
            Лицензиар
        </div>
        <div style="border-bottom: 1px solid black;width: 77%; float: left;">
            <?=$document->partner['name']?>, ИНН <?=$document->partner['INN']?>, <?=$document->partner['mail_address']?>, тел.: <?=$document->partner['tel']?>, р/с <?=$document->partner['payment_account']?>, в банке <?=$document->partner->bank['name']?>, БИК <?=$document->partner['bik']?>, к/с <?=$document->partner->bank['ks']?>
        </div>
    </div>
    <div class="row">
        <div style="text-align: right; width: 20%; float: left; padding-right: 5px">
            Плательщик
        </div>
        <div style="border-bottom: 1px solid black;width: 77%; float: left;">
            <?=$document->partner['name']?>, ИНН <?=$document->partner['INN']?>, <?=$document->partner['mail_address']?>, тел.: <?=$document->partner['tel']?>, р/с <?=$document->partner['payment_account']?>, в банке <?=$document->partner->bank['name']?>, БИК <?=$document->partner['bik']?>, к/с <?=$document->partner->bank['ks']?>
        </div>
    </div>
    <div class="row">
        <div style="text-align: right; width: 20%; float: left; padding-right: 5px">
            Основание
        </div>
        <div style="border-bottom: 1px solid black;width: 77%; float: left;">
            Основной договор
        </div>
    </div>


    <br>

    <div class="row">
        <div style="text-align: right; width: 50%; float: left;">
            <br>
            <br>
            <strong style="font-size: 12pt">АКТ НА ПЕРЕДАЧУ ПРАВ</strong>
        </div>
        <div style="width: 30%; float: left;">
            <table class="table table-bordered" style="font-size: 8pt; width: 30%; float: left;">
                <tr>
                    <td>Номер документа</td>
                    <td>Дата составления</td>
                </tr>
                <tr style="font-size: 12pt">
                    <td style="border: 2px solid black;"><?=$document->id?></td>
                    <td style="border: 2px solid black;"><?=$document->data_document?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <?=$document->company['name']?> и <?=$document->partner['name']?> составили и подписали настоящий Акт приема-передачи о том, что <?=$document->company['name']?> передал, а <?=$document->partner['name']?> принял(о) неисключительные (ограниченные) права, как они описаны в Лицензионном договоре между сторонами, на указанные ниже, программы для ЭВМ и базы данных в составе:
    </div>
    <div class="row">
        <table border="1" class="" cellspacing="0" cellpadding="0" width="100%"  style="font-size: 8pt">
            <tbody>
            <tr>
                <td width="3%" rowspan="2" valign="top">
                    <p>
                        Но-
                        <br/>
                        мер
                        <br/>
                        по по-
                        <br/>
                        рядку
                    </p>
                </td>
                <td width="20%" colspan="2" valign="top">
                    <p align="center">
                        Программный продукт
                    </p>
                </td>
                <td width="12%" colspan="2" valign="top">
                    <p align="center">
                        Единица измерения
                    </p>
                </td>
                <td width="7%" rowspan="2" valign="top">
                    <p>
                        Вид упаковки
                    </p>
                </td>
                <td width="12%" colspan="2" valign="top">
                    <p align="center">
                        Количество
                    </p>
                </td>
                <td width="6%" rowspan="2" valign="top">
                    <p align="center">
                        Масса брутто
                    </p>
                </td>
                <td width="6%" rowspan="2" valign="top">
                    <p align="center">
                        Коли-
                        <br/>
                        чество
                        <br/>
                        (масса
                        <br/>
                        нетто)
                    </p>
                </td>
                <td width="6%" rowspan="2" valign="top">
                    <p align="center">
                        Цена,
                        <br/>
                        руб. коп.
                    </p>
                </td>
                <td width="6%" rowspan="2" valign="top">
                    <p align="center">
                        Сумма без
                        <br/>
                        учета НДС,
                        <br/>
                        руб. коп.
                    </p>
                </td>
                <td width="12%" colspan="2" valign="top">
                    <p align="center">
                        НДС
                    </p>
                </td>
                <td width="5%" rowspan="2" valign="top">
                    <p>
                        Сумма с
                        <br/>
                        учетом
                        <br/>
                        НДС,
                        <br/>
                        руб. коп.
                    </p>
                </td>
            </tr>
            <tr>
                <td width="13%" valign="top">
                    <p align="center">
                        наименование, характеристика, сорт, артикул программного
                        продукта
                    </p>
                </td>
                <td width="5%" valign="top">
                    <p align="center">
                        код
                    </p>
                </td>
                <td width="5%" valign="top">
                    <p align="center">
                        наиме- нование
                    </p>
                </td>
                <td width="6%" valign="top">
                    <p align="center">
                        код по ОКЕИ
                    </p>
                </td>
                <td width="6%" valign="top">
                    <p align="center">
                        в одном месте
                    </p>
                </td>
                <td width="6%" valign="top">
                    <p align="center">
                        мест,
                        <br/>
                        штук
                    </p>
                </td>
                <td width="6%" valign="top">
                    <p align="center">
                        ставка, %
                    </p>
                </td>
                <td width="6%" valign="top">
                    <p align="center">
                        сумма,
                        <br/>
                        руб. коп.
                    </p>
                </td>
            </tr>
            <tr style="text-align: center;">
                <td width="4%" valign="top">
                    <p align="center">
                        1
                    </p>
                </td>
                <td width="13%" valign="top">
                    <p align="center">
                        2
                    </p>
                </td>
                <td width="5%" valign="top">
                    <p align="center">
                        3
                    </p>
                </td>
                <td width="5%" valign="top">
                    <p align="center">
                        4
                    </p>
                </td>
                <td width="6%" valign="top">
                    <p align="center">
                        5
                    </p>
                </td>
                <td width="7%" valign="top">
                    <p align="center">
                        6
                    </p>
                </td>
                <td width="6%" valign="top">
                    <p align="center">
                        7
                    </p>
                </td>
                <td width="6%" valign="top">
                    <p align="center">
                        8
                    </p>
                </td>
                <td width="6%" valign="top">
                    <p align="center">
                        9
                    </p>
                </td>
                <td width="6%" valign="top">
                    <p align="center">
                        10
                    </p>
                </td>
                <td width="6%" valign="top">
                    <p align="center">
                        11
                    </p>
                </td>
                <td width="6%" valign="top">
                    <p align="center">
                        12
                    </p>
                </td>
                <td width="6%" valign="top">
                    <p align="center">
                        13
                    </p>
                </td>
                <td width="6%" valign="top">
                    <p align="center">
                        14
                    </p>
                </td>
                <td width="5%" valign="top">
                    <p align="center">
                        15
                    </p>
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
                <td width="4%" valign="top">
                    <?=$k?>
                </td>
                <td width="13%" valign="top">
                    <?=$item->product['name']?>
                </td>
                <td width="5%" valign="top">
                    <?=$item->product_id?>
                </td>
                <td width="5%" valign="top">
                    шт.
                </td>
                <td width="6%" valign="top">
                </td>
                <td width="7%" valign="top">
                </td>
                <td width="6%" valign="top">
                </td>
                <td width="6%" valign="top">
                </td>
                <td width="6%" valign="top">
                </td>
                <td width="6%" valign="top">
                    <?=$item->quantity?>
                </td>
                <td width="6%" valign="top">
                    <?=$item->price?>
                </td>
                <td width="6%" valign="top">
                    <?=$item->quantity*$item->price?>
                </td>
                <td width="6%" valign="top">
                    Без НДС
                </td>
                <td width="6%" valign="top">
                </td>
                <td width="5%" valign="top">
                    <?=$item->quantity*$item->price?>
                </td>
            </tr>
            <?php }?>
            <tr>
                <td width="49%" colspan="7" valign="right" style="text-align: right">
                        Итого
                </td>
                <td width="6%" valign="top">
                </td>
                <td width="6%" valign="top">
                </td>
                <td width="6%" valign="top">
                    <?=$count_prod?>
                </td>
                <td width="6%" valign="top">
                </td>
                <td width="6%" valign="top">
                    <?=$document->total?>
                </td>
                <td width="6%" valign="top">
                </td>
                <td width="6%" valign="top">

                </td>
                <td width="5%" valign="top">
                    <?=$document->total?>
                </td>
            </tr>
            <tr style="border: 0">
                <td width="49%" colspan="7" valign="right" style="text-align: right">
                    Всего по акту
                </td>
                <td width="6%" valign="top">
                </td>
                <td width="6%" valign="top">
                </td>
                <td width="6%" valign="top">
                    <?=$count_prod?>
                </td>
                <td width="6%" valign="top">
                </td>
                <td width="6%" valign="top">
                    <?=$document->total?>
                </td>
                <td width="6%" valign="top">
                </td>
                <td width="6%" valign="top">

                </td>
                <td width="5%" valign="top">
                    <?=$document->total?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4" style="">
            Акт на передачу прав имеет приложений на
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3" style="border-bottom: 1px solid black;">
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-1 col-sm-1 col-md-1">
            и содержит
        </div>
        <div class="col-xs-7 col-sm-7 col-md-7" style="border-bottom: 1px solid black;">
            <?php
                $num2str = new \app\commands\Num2str();
                echo $num2str->written_number($k)
            ?>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            порядковых номеров записей
        </div>
    </div>
    <br>


</div>
<div style="padding: 0;margin: 0; width: 100%;font-size: 8pt;">
    <div class="" style="border-right:  1px solid black; width: 45%; float: left;<?=($image)? 'min-height: 300px; background-position: 190px 10px; background-image: url(\'/images/pechat.png\'); background-repeat: no-repeat; background-size: 300px;':''?>">
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0;margin: 0;">
            <div class="col-xs-7 col-sm-7 col-md-7" style="padding: 0;margin: 0;">
                Приложение (паспорта, сертификаты и т.п.) нa
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2" style="border-bottom: 1px solid black; padding: 0;margin: 0;">
                <br>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1" style="padding: 0;margin: 0;">
                листах
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0;margin: 0;">
            <div class="col-xs-7 col-sm-7 col-md-7" style="padding: 0;margin: 0;">
                <br>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2" style="padding: 0;margin: 0; text-align: center;font-size: 4pt;">
                прописью
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1" style="padding: 0;margin: 0;">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0;margin: 0;border-bottom: 1px solid black;">
            <?php
            $num2str = new \app\commands\Num2str();
            $ruble = array(1 => 'рубль', 2 => 'рубля', 5 => 'рублей');
            $sum = intval($document->total);
            echo 'Всего отпущено  на сумму: '
                .  $num2str->written_number($sum) . ' ' . $ruble[$num2str->num_125($sum)] . ' 00 коп.';
            ?>
        </div>
        <br>
        <br>
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0;margin: 0;">
            <div class="col-xs-3 col-sm-3 col-md-3" style="padding: 0;margin: 0;">
                От Лицензиара
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2" style="padding: 0;margin: 0; border-bottom: 1px solid black;">
                <br>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2" style=" margin-left:3px; border-bottom: 1px solid black;">
                <br>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4" style="padding: 0;margin: 0; margin-left:3px; border-bottom: 1px solid black;">
                Ефимов С.Н.
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0;margin: 0;">
            <div class="col-xs-3 col-sm-3 col-md-3" style="padding: 0;margin: 0;">
                <br>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2" style="padding: 0;margin: 0;text-align: center;font-size: 4pt; ">
                прописью
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2" style=" margin-left:3px;text-align: center;font-size: 4pt;">
                прописью
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4" style="padding: 0;margin: 0; margin-left:3px; text-align: center;font-size: 4pt;">
                расшифровка подписи
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0;margin: 0;">
            <div class="col-xs-5 col-sm-5 col-md-5" style="padding: 0;margin: 0; text-align: center">
                М.П.
            </div>
            <div class="col-xs-5 col-sm-5 col-md-5" style="padding: 0;margin: 0; border-bottom: 1px solid black; text-align: center">
                <?=Yii::$app->formatter->asDate($document->data_document)?>
            </div>
        </div>
    </div>
    <div style=" width: 50%;float: left">
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0;margin: 0;">
            <div class="col-xs-3 col-sm-3 col-md-3" style="padding: 0;margin: 0;">
                По доверенности №
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9" style="padding: 0;margin: 0; border-bottom: 1px solid black; text-align: center">
                от
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0;margin: 0;">
            <div class="col-xs-3 col-sm-3 col-md-3" style="padding: 0;margin: 0;">
                выданной
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9" style="padding: 0;margin: 0; border-bottom: 1px solid black; text-align: center">
                <br>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0;margin: 0;">
            <div class="col-xs-3 col-sm-3 col-md-3" style="padding: 0;margin: 0; text-align: center">
                <br>
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9" style="padding: 0;margin: 0; font-size: 4pt; text-align: center">
                кем, кому (организация, должность, фамилия, и. о.)
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0;margin: 0;">
            <div class="col-xs-3 col-sm-3 col-md-3" style="padding: 0;margin: 0; text-align: center">
                <br>
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9" style="padding: 0;margin: 0; border-bottom: 1px solid black; text-align: center">
                <br>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0;margin: 0;">
            <div class="col-xs-3 col-sm-3 col-md-3" style="padding: 0;margin: 0; text-align: center">
                <br>
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9" style="padding: 0;margin: 0; border-bottom: 1px solid black; text-align: center">
                <br>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0;margin: 0;">
            <div class="col-xs-3 col-sm-3 col-md-3" style="padding: 0;margin: 0;">
                От Лицензиара
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2" style="padding: 0;margin: 0; border-bottom: 1px solid black;">
                <br>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2" style=" margin-left:3px; border-bottom: 1px solid black;">
                <br>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4" style="padding: 0;margin: 0; margin-left:3px; border-bottom: 1px solid black;">
                <br>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="">
            <div class="col-xs-3 col-sm-3 col-md-3" style="padding: 0;margin: 0;">
                <br>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2" style="padding: 0;margin: 0;text-align: center;font-size: 4pt; ">
                прописью
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2" style=" margin-left:3px;text-align: center;font-size: 4pt;">
                прописью
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4" style="padding: 0;margin: 0; margin-left:3px; text-align: center;font-size: 4pt;">
                расшифровка подписи
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0;margin: 0;">
            <div class="col-xs-5 col-sm-5 col-md-5" style="padding: 0;margin: 0; text-align: center">
                М.П.
            </div>
            <div class="col-xs-5 col-sm-5 col-md-5" style="padding: 0;margin: 0; border-bottom: 1px solid black; text-align: center">
                <br>
            </div>
        </div>
    </div>
</div>
