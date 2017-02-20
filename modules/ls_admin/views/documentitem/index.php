<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\ls_admin\models\DocumentItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Document Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Document Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_id',
            'quantity',
            'price',
            'order_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
