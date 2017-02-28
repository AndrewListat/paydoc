<?php

namespace app\modules\ls_admin\models;

use Yii;

/**
 * This is the model class for table "prefix_document_mail".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $data_send
 * @property string $data_return
 * @property integer $sheets
 * @property integer $price
 * @property integer $type_id
 * @property integer $return
 */
class DocumentMail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prefix_document_mail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['order_id', 'sheets', 'price', 'type_id', 'return'], 'integer'],
            [['data_send', 'data_return'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'data_send' => 'Отправлен',
            'data_return' => 'вернулса',
            'sheets' => 'Кол-во лис.',
            'price' => 'Цена писма',
            'type_id' => 'Вид письма',
            'return' => 'Причина возврата',
        ];
    }
}
