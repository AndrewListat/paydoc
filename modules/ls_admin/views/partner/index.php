<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\ls_admin\models\PartnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контрагенты';
?>
<div class="partner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать контрагента', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box">
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'INN',
            'KPP',
            'name',
            [
                'attribute'=> 'type_partner',
                'filter' => ['1'=>'Физическое лицо','2'=>'Юридическое лицо'],
                'content'=>function($data){
                    if($data->type_partner == 1){
                        return 'Физическое лицо';
                    } else {
                        return 'Юридическое лицо';
                    }
                }
            ],
             'business_address:ntext',
             'mail_address:ntext',
             'tel',
             'bik',
             'payment_account',
             'note',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => ' {update} {delete}',
            ],
        ],
    ]); ?>
    </div>
</div>
