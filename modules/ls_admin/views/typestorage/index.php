<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\ls_admin\models\TypeStorageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Склады';
?>
<div class="type-storage-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать склад', '#', ['class' => 'btn btn-success', 'data-toggle'=>"modal", 'data-target'=>"#myModal"]) ?>
    </p>
    <div class="box">
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
//                'header'=>'Действия',
                'template' => '{update} {delete} ',
                'buttons' => [
                    'update' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon glyphicon-pencil"></span>',
                            '#',['onclick'=>'up_store('.$model->id.',"'.$model->name.'")']);
                    },
                ],
            ],
        ],
    ]); ?>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Создать склад</h4>
                </div>
                <div class="modal-body">
                    <?= $form->field($store, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="upModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Редактировать склад</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label" for="typestorage-name">Наименование</label>
                    <input type="text" class="form-control" name="up_name" id="up_name" maxlength="256" aria-required="true" aria-invalid="true" required>
                    <input type="hidden" class="form-control" id="up_id" name="up_id">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="submit" name="up_store" class="btn btn-primary">Сохранить</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script>
    function up_store(id,name) {
        $('#up_id').val(id);
        $('#up_name').val(name);
        $('#upModal').modal('show');
    }
</script>