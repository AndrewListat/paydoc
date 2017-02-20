<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\Product */

$this->title = 'Update Product: ' . $model->name;
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
      <?= Html::a('Назад', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
