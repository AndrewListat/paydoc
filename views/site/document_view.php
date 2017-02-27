<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;
\app\assets\BaseAsset::register($this);
/**
 * Created by PhpStorm.
 * User: Listat
 * Date: 20.02.2017
 * Time: 12:24
 */
Yii::$app->formatter->locale = 'ru-RU';

$id_doc = ($document->nomber_1c) ? $document->nomber_1c : $document->id;

$paid = ($document->paid)?'Оплачен':'';

$this->title = 'Счет на оплату № '. $id_doc .' от ' . Yii::$app->formatter->asDate($document->data_document).' '.$paid;

?>
<div class="row">
    <div class="col-md-7">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="col-md-5">
        <?php echo Html::a('<img class="left" width="30px" src="/images/filetype_pdf.png" />', ['/api/doc_pdf?id='.$document->id], [
            'class'=>'btn btn-default pull-right',
            'style'=>'margin: 5px',
            'target'=>'_blank',
            'data-toggle'=>'tooltip',
            'title'=>'Счет на оплата без печати'
        ]);?>
        <?php echo Html::a('<img class="left" width="30px" src="/images/filetype_pdf.png" />', ['/api/doc_pdf?id='.$document->id], [
            'class'=>'btn btn-default pull-right',
            'style'=>'margin: 5px',
            'target'=>'_blank',
            'data-toggle'=>'tooltip',
            'title'=>'Счет на оплату с печатью'
        ]);?>
        <?php echo Html::a('<img class="left" width="30px" src="/images/filetype_pdf.png" />', ['/api/doc_pdf?id='.$document->id], [
            'class'=>'btn btn-default pull-right',
            'style'=>'margin: 5px',
            'target'=>'_blank',
            'data-toggle'=>'tooltip',
            'title'=>'Акт о передачи права без печати'
        ]);?>
        <?php echo Html::a('<img class="left" width="30px" src="/images/filetype_pdf.png" />', ['/api/doc_pdf?id='.$document->id], [
            'class'=>'btn btn-default pull-right',
            'style'=>'margin: 5px',
            'target'=>'_blank',
            'data-toggle'=>'tooltip',
            'title'=>'Акт о передачи права с печать'
        ]);?>
        <?php echo Html::a('<img class="left" width="30px" src="/images/filetype_pdf.png" />', ['/api/doc_pdf?id='.$document->id], [
            'class'=>'btn btn-default pull-right',
            'style'=>'margin: 5px',
            'target'=>'_blank',
            'data-toggle'=>'tooltip',
            'title'=>'Договор без печати'
        ]);?>
        <?php echo Html::a('<img class="left" width="30px" src="/images/filetype_pdf.png" />', ['/api/doc_pdf?id='.$document->id], [
            'class'=>'btn btn-default pull-right',
            'style'=>'margin: 5px',
            'target'=>'_blank',
            'data-toggle'=>'tooltip',
            'title'=>'Договор c печати'
        ]);?>
    </div>
</div>




<div class="pages-index">
    <?php $form = ActiveForm::begin(); ?>


    <?= ($document->nomber_1c) ? $form->field($document, 'nomber_1c')->textInput(['maxlength' => true,'disabled'=>true]) : $form->field($document, 'id')->textInput(['maxlength' => true,'disabled'=>true]) ?>


    <div class="row">
        <div class="col-md-12">
            <?php \yii\widgets\Pjax::begin(['id' => 'partnerId','timeout' => false, 'enablePushState' => false,]); ?>
            <?php
            $cusName =  empty($document->partner_id) ? '' : \app\modules\ls_admin\models\Partner::findOne($document->partner_id)->name;
            echo $form->field($document, 'partner_id')->widget(Select2::classname(), [
                'initValueText' => $cusName, // set the initial display text
                'disabled'=>true,
                'options' => ['placeholder' => 'Search for ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
//                    'language' => [
//                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
//                    ],
                    'language'=> 'ru',
                    'ajax' => [
                        'url' => '/api/partner',
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(city) { return city.text; }'),
                    'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                ],
            ])->label('Контрагент');
            ?>
            <?php \yii\widgets\Pjax::end()?>
        </div>
    </div>

    <?php
    echo $form->field($document, 'company_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\modules\ls_admin\models\Company::find()->all(),'id','name'),
        'options' => ['placeholder' => 'Select ...'],
        'disabled'=>true,
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Организация');
    ?>

    <?= $form->field($document, 'status_id')->textInput(['disabled'=>true]) ?>

    <div class="box">
        <?php \yii\widgets\Pjax::begin(['id' => 'productItems','timeout' => false, 'enablePushState' => false,]); ?>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $documentItemsDataProvider,
            'showFooter'=>TRUE,
            'footerRowOptions'=>['style'=>'font-weight:bold;'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //            'id',
                //            'product_id',
                [
                    //                'label' => 'Сума',
                    'attribute' => 'product.name',
                ],
                'quantity',
                [
                    //                'label' => 'Сума',
                    'attribute' => 'price',
                    //                'footer' => 'Общая сумма:'
                ],
                [
                    'label' => 'Сума',
                    //                'format'=>'row',
                    'value' => function ($model, $key, $index, $widget) {
                        return $model->price * $model->quantity;
                    },
                    'footer' => $document->total ? 'Общая сумма: '.$document->total : '',
                ],
            ],
        ]); ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
    <?= $form->field($document, 'delivery_address')->textarea(['rows' => 3,'disabled'=>true]) ?>
    <?= $form->field($document, 'note')->textarea(['rows' => 6,'disabled'=>true]) ?>

    <div class="form-group">
        <?= Html::a('Закрыть', ['index'] , ['name'=>'add_document','class' => 'btn btn-danger' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>