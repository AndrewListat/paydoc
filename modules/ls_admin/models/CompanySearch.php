<?php

namespace app\modules\ls_admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ls_admin\models\Company;

/**
 * CompanySearch represents the model behind the search form about `app\modules\ls_admin\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'INN', 'KPP', 'type_partner'], 'integer'],
            [['name', 'business_address', 'mail_address', 'tel', 'bik', 'payment_account', 'note'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Company::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'INN' => $this->INN,
            'KPP' => $this->KPP,
            'type_partner' => $this->type_partner,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'business_address', $this->business_address])
            ->andFilterWhere(['like', 'mail_address', $this->mail_address])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'bik', $this->bik])
            ->andFilterWhere(['like', 'payment_account', $this->payment_account])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
