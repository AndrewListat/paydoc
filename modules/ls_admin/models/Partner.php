<?php

namespace app\modules\ls_admin\models;

use Yii;

/**
 * This is the model class for table "prefix_partner".
 *
 * @property integer $id
 * @property integer $INN
 * @property integer $KPP
 * @property string $name
 * @property integer $type_partner
 * @property string $business_address
 * @property string $mail_address
 * @property string $tel
 * @property string $bik
 * @property string $payment_account
 * @property string $note
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prefix_partner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INN', 'KPP', 'name', 'type_partner', 'business_address', 'mail_address', 'tel', 'bik', 'payment_account', 'note'], 'required'],
            [['INN', 'KPP', 'type_partner'], 'integer'],
            [['business_address', 'mail_address', 'note'], 'string'],
            [['name'], 'string', 'max' => 1000],
            [['tel', 'payment_account'], 'string', 'max' => 20],
            [['bik'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'INN' => 'Inn',
            'KPP' => 'Kpp',
            'name' => 'Name',
            'type_partner' => 'Type Partner',
            'business_address' => 'Business Address',
            'mail_address' => 'Mail Address',
            'tel' => 'Tel',
            'bik' => 'Bik',
            'payment_account' => 'Payment Account',
            'note' => 'Note',
        ];
    }
}
