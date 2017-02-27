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
 * @property string $email
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
            [['INN', 'name', 'type_partner', 'business_address', 'mail_address','email', 'tel', 'bik', 'payment_account'], 'required'],
            [['INN', 'KPP', 'type_partner'], 'integer'],
            [['business_address', 'mail_address', 'note', 'name_bank', 'kor_rah'], 'string'],
            [['name'], 'string', 'max' => 1000],
            [['tel', 'payment_account'], 'string', 'max' => 20],
            [['bik'], 'string', 'max' => 10],
            ['email', 'email'],
            ['email', 'unique', 'message' => 'Этот email уже зарегистрирован, нужно востнановить пароль на главной странице по Этому Email'],
            ['INN', 'unique', 'message' => 'Этот INN уже зарегистрирован, нужно востнановить пароль на главной странице по Email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'INN' => 'ИНН',
            'KPP' => 'КПП',
            'name' => 'Наименование',
            'type_partner' => 'Юр. / физ. лицо',
            'business_address' => 'Юридический адрес',
            'mail_address' => 'Почтовый адрес',
            'email' => 'Email',
            'tel' => 'Тел.',
            'bik' => 'Бик банка',
            'payment_account' => 'Расчетный счет',
            'note' => 'Комментарий',
        ];
    }
    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);
        $model = new RegForm();
        if (Yii::$app->user->isGuest){

                $model->username = $this->name;
                $model->lastname = 'Last '.$this->name;
                $model->password = Yii::$app->getSecurity()->generateRandomString(6);
                $model->login = 'user_'.time();
                $model->email = $this->email;
                $model->role = 'user';
                $model->partner_id = $this->id;
                if ( $model->validate()):
                    if ($user = $model->reg()):
                        if ($user->status === User::STATUS_ACTIVE):
                             Yii::$app->getUser()->login($user);
                        endif;
                    endif;
                endif;
        } elseif (Yii::$app->user->identity['role']== 'admin'){
            $model = new RegForm();
            $model->username = $this->name;
            $model->lastname = 'Last '.$this->name;
            $model->password = Yii::$app->getSecurity()->generateRandomString(6);
            $model->login = 'user_'.time();
            $model->email = $this->email;
            $model->role = 'user';
            $model->partner_id = $this->id;
            if ( $model->validate()):
                if ($user = $model->reg()):
                endif;
            endif;
        }else{
            $model->username = $this->name;
            $model->lastname = 'Last '.$this->name;
            $model->password = Yii::$app->getSecurity()->generateRandomString(6);
            $model->login = 'user_'.time();
            $model->email = $this->email;
            $model->role = 'user';
            $model->partner_id = $this->id;
            if ( $model->validate()):
                if ($user = $model->reg()):
                    if ($user->status === User::STATUS_ACTIVE):
                        Yii::$app->getUser()->login($user);
                    endif;
                endif;
            endif;
        }

    }
}
