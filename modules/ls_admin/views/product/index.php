<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\ls_admin\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Номенклатура';
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать номенклатуру', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box">
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'price.price',
            [
                'attribute'=>'price.type.name',
                'label'=>'Тип валюты',
            ],


//            'sky',
//            'group',
//            'unit',
            'date_added',
            'date_modified',
//            'note:ntext',
//            'service',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => ' {update} {delete}',
            ],
        ],
    ]); ?>
    </div>
</div>
