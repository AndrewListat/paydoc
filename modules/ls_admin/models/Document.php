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
            [[ 'partner_id', 'company_id', 'total', 'paid', 'status_id'], 'required'],
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
            'id' => 'Номер',
            'data_document' => 'Дата',
            'nomber_1c' => 'Номер из 1С',
            'delivery_address' => 'Адрес доставки',
            'partner_id' => 'Контрагент',
            'company_id' => 'Организация',
            'total' => 'Сумма документа',
            'paid' => 'Оплачено',
            'status_id' => 'Статус',
            'note' => 'Комментарий',
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
    public function getStatus()
    {
        return $this->hasOne(StatusDocument::className(), ['id' => 'status_id']);
    }

    public function beforeSave($insert){
        $this->data_document = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
        return parent::beforeSave($insert);
    }
}
