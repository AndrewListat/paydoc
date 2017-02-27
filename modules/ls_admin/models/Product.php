<?php

namespace app\modules\ls_admin\models;

use Yii;

/**
 * This is the model class for table "prefix_product".
 *
 * @property integer $id
 * @property string $name
 * @property string $sky
 * @property integer $group
 * @property string $unit
 * @property string $date_added
 * @property string $date_modified
 * @property string $note
 * @property integer $service
 * @property integer $onlyAdmin
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prefix_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sky', 'group', 'unit', 'note', 'service'], 'required'],
            [['group', 'service','onlyAdmin'], 'integer'],
            [['date_added', 'date_modified'], 'safe'],
            [['note'], 'string'],
            [['name'], 'string', 'max' => 256],
            [['sky'], 'string', 'max' => 56],
            [['unit'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'sky' => 'Артикул',
            'group' => 'Group',
            'unit' => 'Unit',
            'date_added' => 'Дата добавления',
            'date_modified' => 'Дата модификации',
            'note' => 'Описание',
            'service' => 'Service',
            'onlyAdmin ' => 'onlyAdmin ',
        ];
    }

    public function getPrice()
    {
        return $this->hasOne(ProductPrice::className(), ['product_id' => 'id']);
    }

    public function getStock()
    {
        return $this->hasOne(ProductStock::className(), ['product_id' => 'id']);
    }

    public function beforeSave($insert){
      if ($this->isNewRecord){
        $this->date_added = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
      }
      $this->date_modified = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
      return parent::beforeSave($insert);
    }
}
