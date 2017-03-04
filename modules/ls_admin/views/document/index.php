<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\ls_admin\models\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$total = 0;
$this->title = 'Журнал документов';
Yii::$app->formatter->locale = 'ru-RU';
?>
<div class="document-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <!-- <p>
        <?php /*Html::a('Create Document', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->
    <div class="box docs">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
//        'showFooter'=>TRUE,
            'rowOptions' => function ($model, $key, $index, $grid){
                return [
                    'ondblclick'=>'window.location = "/admin/document/update?id='.$model->id.'"',
                ];
            },
            'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute'=>'id',
                    'headerOptions' => ['style' => 'width: 50px;'],
                ],
                [
                    'attribute'=>'nomber_1c',
                    'headerOptions' => ['style' => 'width: 50px;'],
                ],
                [
                    'label'=>'Дата документа',
                    'attribute'=>'data_document',
                    'content'=>function($document){
                        return Yii::$app->formatter->asDate($document->data_document);
                    },
                    'filter' => \kartik\widgets\DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'data_document',
                        'type' => \kartik\widgets\DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]),
                    'headerOptions' => ['style' => 'width: 50px;'],
                ],
                [
                    'attribute'=>'delivery_address',
                    'enableSorting' => false,
                ],
                [
                    'attribute' => 'partner_id',
                    'value'=>'partner.name',
                    'label'=>'Контрагент',
                ],
                [
                    'attribute'=>'company.name',
                    'label'=>'Организация',
                ],
                [
                    'attribute'=> 'total',
                    'enableSorting' => false,
                ],
                [
                    'label'=>'Оплачено',
                    'content'=>function($data){
                        return Html::checkbox('paid',$data->paid,['onclick'=>'update_paid('.$data->id.')','id'=>'update_paid_id_'.$data->id]);
                    }
                ],
                [
                    'attribute'=> 'status_id',
                    'label'=>'Статус',
                    'content'=>function($data){
                        if ($data->status_id == 0){
                            return 'не определен';
                        } else {
                            return $data->status['name'];
                        }
                    },
                    'filter' => \yii\helpers\ArrayHelper::map(\app\modules\ls_admin\models\StatusDocument::find()->all(), 'id', 'name'),

                ],
//                'status_id',
                [
                    'attribute'=> 'note',
                    'enableSorting' => false,
                ],

//            ['class' => 'yii\grid\ActionColumn'],
                [
                    'class' => 'yii\grid\ActionColumn',
//                'header'=>'Действия',
                    'template' => ' {delete}',
                ],
            ],
        ]); ?>
    </div>

</div>
<script>
    function update_paid(id) {
        var status = $('#update_paid_id_'+id).is(':checked');
        $.post( "/api/update_paid",{ id: id, status: status }, function( data ) {
            console.log(data)
        });
    }
</script>