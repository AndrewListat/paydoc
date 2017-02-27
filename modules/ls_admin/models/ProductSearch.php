<?php

namespace app\modules\ls_admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ls_admin\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\modules\ls_admin\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group', 'service','parent_id'], 'integer'],
            [['name', 'sky', 'unit', 'date_added', 'date_modified', 'note'], 'safe'],
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
        $query = Product::find();

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
            'group' => $this->group,
            'date_added' => $this->date_added,
            'date_modified' => $this->date_modified,
            'parent_id' => $this->parent_id,
            'service' => $this->service,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'sky', $this->sky])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
