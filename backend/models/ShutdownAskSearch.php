<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ShutdownAsk;

/**
 * ShutdownAskSearch represents the model behind the search form of `backend\models\ShutdownAsk`.
 */
class ShutdownAskSearch extends ShutdownAsk
{
    public $enterprise;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'staff_id', 'staff_company', 'created_by', 'updated_by'], 'integer'],
            [['enterprise', 'staff_cc', 'staff_admission', 'staff_registry', 'staff_job', 'staff_department', 'shutdown_date', 'company_time', 'shutdown_motive', 'shutdown_initiative', 'admission_period', 'acting_period', 'dismissal_period', 'categories', 'interview_type', 'created_at', 'updated_at'], 'safe']
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
        $query = ShutdownAsk::find();

        // add conditions that should always apply here
        $query->joinWith(['enterprise']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['enterprise'] = [
            'asc' => ['enterprise.company_name' => SORT_ASC],
            'desc' => ['enterprise.company_name' => SORT_DESC],
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
            'staff_company' => $this->staff_company,
            'shutdown_date' => $this->shutdown_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'staff_registry', $this->staff_registry])
            ->andFilterWhere(['like', 'staff_id', $this->staff_id])
            ->andFilterWhere(['like', 'staff_job', $this->staff_job])
            ->andFilterWhere(['like', 'staff_department', $this->staff_department])
            ->andFilterWhere(['like', 'company_time', $this->company_time])
            ->andFilterWhere(['like', 'shutdown_motive', $this->shutdown_motive])
            ->andFilterWhere(['like', 'shutdown_initiative', $this->shutdown_initiative])
            ->andFilterWhere(['like', 'admission_period', $this->admission_period])
            ->andFilterWhere(['like', 'acting_period', $this->acting_period])
            ->andFilterWhere(['like', 'dismissal_period', $this->dismissal_period])
            ->andFilterWhere(['like', 'categories', $this->categories])
            ->andFilterWhere(['like', 'interview_type', $this->interview_type])
        ->andFilterWhere(['like', 'enterprise.company_name', $this->enterprise]);

        return $dataProvider;
    }
}
