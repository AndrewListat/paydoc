<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\ls_admin\models\Product */

$this->title = 'Create Product';
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
      <?= Html::a('Назад', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
