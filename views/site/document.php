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

?>

<div class="pages-index">
  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($document, 'nomber_1c')->textInput(['maxlength' => true]) ?>

  <?= $form->field($document, 'delivery_address')->textarea(['rows' => 3]) ?>
    <div class="row">
        <div class="col-md-10">
            <?php
            \yii\widgets\Pjax::begin(['id' => 'partnerId','timeout' => false, 'enablePushState' => true,]);
            $cusName =  empty($document->partner_id) ? '' : \app\modules\ls_admin\models\Partner::findOne($document->partner_id)->name;
            echo $form->field($document, 'partner_id')->widget(Select2::classname(), [
                'initValueText' => $cusName, // set the initial display text
//                'pluginLoading' => false,
                'options' => ['placeholder' => 'Search for ...','id'=>'select2partner'],
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
        <div class="col-md-2">
            <div class="form-group" style="padding-top: 24px">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Добавить контрагента
                </button>
            </div>
        </div>
    </div>

    <?php
        echo $form->field($document, 'company_id')->widget(Select2::classname(), [
          'data' => \yii\helpers\ArrayHelper::map(\app\modules\ls_admin\models\Company::find()->all(),'id','name'),
          'options' => ['placeholder' => 'Select ...'],
          'pluginOptions' => [
            'allowClear' => true
          ],
        ])->label('Организация');
    ?>

    <div class="form-group">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myTovar">
            Добавить продукт
        </button>
    </div>
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
                'price',
                [
    //                'label' => 'Сума',
                    'attribute' => 'price',
    //                'footer' => 'Общая сумма:'
                ],
    //            'order_id',
                [
                    'label' => 'Сума',
    //                'format'=>'row',
                    'value' => function ($model, $key, $index, $widget) {
                        return $model->price * $model->quantity;
                    },
                    'footer' => $document->total ? 'Общая сумма: '.$document->total : '',
                ],
                [
                    'label'=>'',
                    'content'=>function($data){
                        return '<a><span class="glyphicon glyphicon-trash" aria-hidden="true" onclick="delete_product('.$data->id.')"></span></a>';
                    }
                ],

            ],
        ]); ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>

    <?= $form->field($document, 'note')->textarea(['rows' => 6]) ?>

  <div class="form-group">
    <?= Html::submitButton('Создать' , ['name'=>'add_document','class' => 'btn btn-success' ]) ?>
  </div>

  <?php ActiveForm::end(); ?>
</div>
<!-- Modal Контрагент -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <?php \yii\widgets\Pjax::begin(['id' => 'new_partner']); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Контрагент</h4>
                </div>
                <?php $form = ActiveForm::begin(['options'=>['data-pjax' => '']]); ?>
                    <div class="modal-body">

                        <?= $form->field($kontrahent, 'INN')->textInput() ?>

                        <?= $form->field($kontrahent, 'KPP')->textInput() ?>

                        <?= $form->field($kontrahent, 'name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($kontrahent, 'type_partner')->dropDownList(['1'=>'Физическое лицо','2'=>'Юридическое лицо']) ?>

                        <?= $form->field($kontrahent, 'business_address')->textarea(['rows' => 6]) ?>

                        <?= $form->field($kontrahent, 'mail_address')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($kontrahent, 'tel')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::className(),[
                            'mask' => '(999) 999-9999'
                        ]) ?>

                        <?= $form->field($kontrahent, 'bik')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($kontrahent, 'payment_account')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($kontrahent, 'note')->textarea(['rows' => 6]) ?>

                    </div>
                    <div class="modal-footer">
                        <?= Html::submitButton('Создать' , ['name'=>'add_partner','class' =>  'btn btn-primary']) ?>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary">Напечатать конверт</button>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>

<!-- Modal tovar -->
<div class="modal fade bs-example-modal-lg" id="myTovar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Продукты</h4>
            </div>
            <div class="modal-body">
                <?php \yii\widgets\Pjax::begin(['id' => 'admin-crud-id', 'timeout' => false,
                    'enablePushState' => false,]); ?>

                    <?= \yii\grid\GridView::widget([
                        'dataProvider' => $productDataProvider,
//                        'filterModel' => $productSearch,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'name',
                            'sky',
//                            'group',
                            'unit',
//                            'date_added',
//                            'date_modified',
//                            'note:ntext',
//                            'service',
                            'price.price',
                            [
//                                'attribute'=>'parent_id',
                                'label'=>'Количество',
                                'content'=>function($data){
                                    return '<input type="number" id="count-'.$data->id.'" min="1" value="1"/>';
                                }
                            ],
                            [
//                                'attribute'=>'parent_id',
                                'label'=>'#',
                                'content'=>function($data){
                                    return '<span class="glyphicon glyphicon-plus" aria-hidden="true" onclick="add_product('.$data->id.')"></span>';
                                }
                            ],
//                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                <?php \yii\widgets\Pjax::end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>

    </div>
</div>