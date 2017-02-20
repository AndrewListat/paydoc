<?php

namespace app\modules\ls_admin\models;

use Yii;

/**
 * This is the model class for table "prefix_document".
 *
 * @property integer $id
 * @property string $data_document
 * @property string $nomber_1c
 * @property string $delivery_address
 * @property integer $partner_id
 * @property integer $company_id
 * @property integer $total
 * @property integer $paid
 * @property integer $status_id
 * @property string $note
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prefix_document';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_document', 'nomber_1c', 'delivery_address', 'partner_id', 'company_id', 'total', 'paid', 'status_id', 'note'], 'required'],
            [['data_document'], 'safe'],
            [['delivery_address', 'note'], 'string'],
            [['partner_id', 'company_id', 'total', 'paid', 'status_id'], 'integer'],
            [['nomber_1c'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data_document' => 'Data Document',
            'nomber_1c' => 'Nomber 1c',
            'delivery_address' => 'Delivery Address',
            'partner_id' => 'Partner ID',
            'company_id' => 'Company ID',
            'total' => 'Total',
            'paid' => 'Paid',
            'status_id' => 'Status ID',
            'note' => 'Note',
        ];
    }

    public function getPartner()
    {
      return $this->hasOne(Partner::className(), ['id' => 'partner_id']);
    }
    public function getCompany()
    {
      return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
