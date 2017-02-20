<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\CompanySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'INN') ?>

    <?= $form->field($model, 'KPP') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'type_partner') ?>

    <?php // echo $form->field($model, 'business_address') ?>

    <?php // echo $form->field($model, 'mail_address') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'bik') ?>

    <?php // echo $form->field($model, 'payment_account') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
