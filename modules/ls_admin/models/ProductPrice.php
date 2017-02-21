<?php

namespace app\modules\ls_admin\models;

use Yii;

/**
 * This is the model class for table "prefix_product_price".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $price
 * @property string $data_price
 * @property integer $type_prices_id
 */
class ProductPrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prefix_product_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'price', 'type_prices_id'], 'required'],
            [['product_id', 'price', 'type_prices_id'], 'integer'],
            [['data_price'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'price' => 'Цена',
            'data_price' => 'Data Price',
            'type_prices_id' => 'Тип валюты',
        ];
    }

    public function getType()
    {
        return $this->hasOne(TypePrice::className(), ['id' => 'type_prices_id']);
    }

    public function beforeSave($insert){
        $this->data_price = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
        return parent::beforeSave($insert);
    }
}
