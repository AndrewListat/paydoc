<?php

namespace app\modules\ls_admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ls_admin\models\Document;

/**
 * DocumentSearch represents the model behind the search form about `app\modules\ls_admin\models\Document`.
 */
class DocumentSearch extends Document
{
    /**
     * @inheritdoc
     */
    public $partner_id2;

    public function rules()
    {
        return [
            [['id', 'partner_id', 'company_id', 'paid', 'status_id'], 'integer'],
            [['data_document', 'nomber_1c','partner_name', ], 'safe'],
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
        $query = Document::find()->joinWith('partner');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        var_dump($this->partner_id2);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'data_document' => $this->data_document,
            'partner_id' => $this->partner_id2,
            'company_id' => $this->company_id,
//            'total' => $this->total,
            'paid' => $this->paid,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'nomber_1c', $this->nomber_1c])
            ->andFilterWhere(['like', 'prefix_partner.name', $this->partner_id]);
//            ->andFilterWhere(['like', 'note', $this->note]);

        $query->orderBy(['id'=>SORT_DESC]);

        return $dataProvider;
    }
}
