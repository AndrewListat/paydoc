<?php

namespace app\modules\ls_admin\models;

use Yii;

/**
 * This is the model class for table "prefix_type_mail".
 *
 * @property integer $id
 * @property string $name
 */
class TypeMail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prefix_type_mail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 256],
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
        ];
    }
}
