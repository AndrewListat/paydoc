<?php

namespace app\modules\ls_admin\models;

use Yii;

/**
 * This is the model class for table "prefix_type_price".
 *
 * @property integer $id
 * @property string $name
 * @property integer $NDS
 * @property string $currency
 */
class TypePrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prefix_type_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'NDS', 'currency'], 'required'],
            [['NDS'], 'integer'],
            [['name'], 'string', 'max' => 256],
            [['currency'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'NDS' => 'Nds',
            'currency' => 'Currency',
        ];
    }
}
