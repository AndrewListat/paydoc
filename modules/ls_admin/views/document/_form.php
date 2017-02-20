<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_document')->textInput() ?>

    <?= $form->field($model, 'nomber_1c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'partner_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\modules\ls_admin\models\Partner::find()->all(),'id','name')); ?>

    <?= $form->field($model, 'company_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\modules\ls_admin\models\Company::find()->all(),'id','name')) ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'paid')->textInput() ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
