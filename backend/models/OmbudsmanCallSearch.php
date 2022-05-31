<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\OmbudsmanCall;

/**
 * OmbudsmanCallSearch represents the model behind the search form of `app\models\OmbudsmanCall`.
 */
class OmbudsmanCallSearch extends OmbudsmanCall
{
    public $ombudsman;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ombudsman_id', 'anonymity'], 'integer'],
            [['ombudsman', 'contact_type', 'department', 'name', 'state', 'city', 'job', 'email', 'phone', 'leader', 'message', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = OmbudsmanCall::find();

        // add conditions that should always apply here
        
        $query->joinWith(['ombudsman']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['ombudsman'] = [
            'asc' => ['ombudsman.name' => SORT_ASC],
            'desc' => ['ombudsman.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ombudsman_id' => $this->ombudsman_id,
            'anonymity' => $this->anonymity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'contact_type', $this->contact_type])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'job', $this->job])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'leader', $this->leader])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'ombudsman.name', $this->ombudsman]);

        return $dataProvider;
    }
}
