<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\Partner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'INN')->textInput() ?>

    <button id="btn_inn" type="button" disabled="disabled" onclick="search_company()" class="btn btn-info">
        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
    </button>

    <?= $form->field($model, 'KPP')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_partner')->dropDownList(['1'=>'Физическое лицо','2'=>'Юридическое лицо']) ?>

    <?= $form->field($model, 'business_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'mail_address')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::className(),[
        'mask' => '(999) 999-9999'
    ]) ?>

    <?= $form->field($model, 'bik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Создать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::submitButton( 'Печать конверта', ['name'=>'print_kobvert', 'class' =>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
