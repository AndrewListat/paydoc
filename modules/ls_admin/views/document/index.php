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
    <div class="box">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'showFooter'=>TRUE,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'nomber_1c',
                [
                        'label'=>'Дата документа',
                        'content'=>function($document){
                            return Yii::$app->formatter->asDate($document->data_document);
                        }
                ],
                'delivery_address:ntext',
                [
                    'attribute'=>'partner.name',
                    'label'=>'Контрагент',
                ],
                [
                    'attribute'=>'company.name',
                    'label'=>'Организация',
                ],
                'total',
                [
                    'label'=>'Оплачено',
                    'content'=>function($data){
                        return Html::checkbox('paid',$data->paid,['onclick'=>'update_paid('.$data->id.')','id'=>'update_paid_id_'.$data->id]);
                    }
                ],
                [
                    'label'=>'Статус',
                    'content'=>function($data){
                        if ($data->status_id == 0){
                            return 'не определен';
                        } else {
                            return $data->status['name'];
                        }
                    }
                ],
//                'status_id',
                'note:ntext',
//            ['class' => 'yii\grid\ActionColumn'],
                [
                    'class' => 'yii\grid\ActionColumn',
//                'header'=>'Действия',
                    'template' => '{update} {delete}',
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