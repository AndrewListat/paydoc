<?php

namespace app\modules\ls_admin\models;

use Yii;

/**
 * This is the model class for table "prefix_product_stock".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $stock
 * @property string $data_stock
 * @property integer $storage_id
 */
class ProductStock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prefix_product_stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'stock', 'storage_id'], 'required'],
            [['product_id', 'stock', 'storage_id'], 'integer'],
            [['data_stock'], 'safe'],
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
            'stock' => 'Склад',
            'data_stock' => 'Data Stock',
            'storage_id' => 'Storage ID',
        ];
    }

    public function beforeSave($insert){
        $this->data_stock = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
        return parent::beforeSave($insert);
    }
}
