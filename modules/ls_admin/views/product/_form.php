<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\Product */
/* @var $form yii\widgets\ActiveForm */



$category = \yii\helpers\ArrayHelper::map(\app\modules\ls_admin\models\Product::find()->where(['group'=>1])->all(),'id','name');
$category[0] =  "Главная";
if (!$model->isNewRecord){
    echo '<script>var update_prod = '.$model->parent_id.';</script>';
}
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'onlyAdmin')->checkbox() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sky')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group')->dropDownList(['0'=>'Товар','1'=>'Категория']) ?>


    <?= $form->field($model, 'parent_id')->hiddenInput()->label('Категория') ?>

    <div id="tree"></div>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'service')->checkbox() ?>

    <?= $form->field($productPrice, 'price')->textInput() ?>

    <?= $form->field($productPrice, 'type_prices_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\modules\ls_admin\models\TypePrice::find()->all(),'id','name'))->label('Тип валюты') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
