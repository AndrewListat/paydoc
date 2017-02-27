<?php

namespace app\modules\ls_admin\models;

use Yii;

/**
 * This is the model class for table "ui_banks".
 *
 * @property string $bik
 * @property string $ks
 * @property string $name
 * @property string $namemini
 * @property string $zip
 * @property string $city
 * @property string $address
 * @property string $phone
 * @property string $okato
 * @property string $okpo
 */
class UiBanks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ui_banks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bik', 'ks', 'name', 'namemini', 'zip', 'city', 'address', 'phone', 'okato', 'okpo'], 'required'],
            [['bik'], 'integer'],
            [['ks', 'name', 'namemini', 'city', 'address', 'phone'], 'string', 'max' => 255],
            [['zip'], 'string', 'max' => 6],
            [['okato'], 'string', 'max' => 2],
            [['okpo'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bik' => 'Bik',
            'ks' => 'Ks',
            'name' => 'Name',
            'namemini' => 'Namemini',
            'zip' => 'Zip',
            'city' => 'City',
            'address' => 'Address',
            'phone' => 'Phone',
            'okato' => 'Okato',
            'okpo' => 'Okpo',
        ];
    }
}
