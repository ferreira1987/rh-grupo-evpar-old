<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ShutdownChecklist;

/**
 * ShutdownChecklistSearch represents the model behind the search form of `backend\models\ShutdownChecklist`.
 */
class ShutdownChecklistSearch extends ShutdownChecklist
{
    public $enterprise;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'requester_id', 'staff_company', 'updated_by'], 'integer'],
            [['enterprise', 'staff_registry', 'staff_job', 'staff_department', 'dp_authorization', 'director_authorization', 'rh_authorization', 'shutdown_motive', 'e1_interview', 'e1_dental_plan', 'e1_health_plan', 'e1_date', 'e2_early_warning', 'e2_date', 'e3_access_blocking', 'e3_return_equipment', 'e3_date', 'e4_return_vehicle', 'e4_date', 'e5_return_tools', 'e5_date', 'e6_return_epis', 'e6_return_uniform', 'e6_date', 'e7_aso_dismissal', 'e7_homologation', 'e7_date', 'created_at', 'updated_at'], 'safe'],
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
        $query = ShutdownChecklist::find();

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
            'requester_id' => $this->requester_id,
            'staff_company' => $this->staff_company,
            'e1_date' => $this->e1_date,
            'e2_date' => $this->e2_date,
            'e3_date' => $this->e3_date,
            'e4_date' => $this->e4_date,
            'e5_date' => $this->e5_date,
            'e6_date' => $this->e6_date,
            'e7_date' => $this->e7_date,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'staff_registry', $this->staff_registry])
            ->andFilterWhere(['like', 'staff_job', $this->staff_job])
            ->andFilterWhere(['like', 'staff_department', $this->staff_department])
            ->andFilterWhere(['like', 'dp_authorization', $this->dp_authorization])
            ->andFilterWhere(['like', 'director_authorization', $this->director_authorization])
            ->andFilterWhere(['like', 'rh_authorization', $this->rh_authorization])
            ->andFilterWhere(['like', 'shutdown_motive', $this->shutdown_motive])
            ->andFilterWhere(['like', 'e1_interview', $this->e1_interview])
            ->andFilterWhere(['like', 'e1_dental_plan', $this->e1_dental_plan])
            ->andFilterWhere(['like', 'e1_health_plan', $this->e1_health_plan])
            ->andFilterWhere(['like', 'e2_early_warning', $this->e2_early_warning])
            ->andFilterWhere(['like', 'e3_access_blocking', $this->e3_access_blocking])
            ->andFilterWhere(['like', 'e3_return_equipment', $this->e3_return_equipment])
            ->andFilterWhere(['like', 'e4_return_vehicle', $this->e4_return_vehicle])
            ->andFilterWhere(['like', 'e5_return_tools', $this->e5_return_tools])
            ->andFilterWhere(['like', 'e6_return_epis', $this->e6_return_epis])
            ->andFilterWhere(['like', 'e6_return_uniform', $this->e6_return_uniform])
            ->andFilterWhere(['like', 'e7_aso_dismissal', $this->e7_aso_dismissal])
            ->andFilterWhere(['like', 'e7_homologation', $this->e7_homologation])
        ->andFilterWhere(['like', 'enterprise.company_name', $this->enterprise]);

        return $dataProvider;
    }
}
