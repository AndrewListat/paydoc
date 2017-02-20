<?php

namespace app\modules\ls_admin\models;

use Yii;

/**
 * This is the model class for table "prefix_document_item".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $quantity
 * @property integer $price
 * @property integer $order_id
 */
class DocumentItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prefix_document_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'quantity', 'price', 'order_id'], 'required'],
            [['product_id', 'quantity', 'price', 'order_id'], 'integer'],
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
            'quantity' => 'Quantity',
            'price' => 'Price',
            'order_id' => 'Order ID',
        ];
    }
}
