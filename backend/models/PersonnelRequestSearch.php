<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RequestForm;

/**
 * PersonnelRequestSearch represents the model behind the search form of `backend\models\RequestForm`.
 */
class PersonnelRequestSearch extends PersonnelRequest
{
    public $enterprise;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vacancy_company', 'vacancy_quantity', 'updated_by'], 'integer'],
            [['enterprise', 'requester_id', 'vacancy_office', 'vacancy_variable', 'vacancy_benefits', 'vacancy_type', 'vacancy_workload', 'vacancy_motive', 'vacancy_gender', 'vacany_confidential', 'vacancy_formation', 'vacancy_activities', 'vacancy_requirements', 'requester_authorization', 'director_authorization', 'rh_authorization', 'created_at', 'updated_at'], 'safe'],
            [['vacancy_salary'], 'number'],
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
        $profile = \Yii::$app->user->identity->profile;
        $permission = ['ADMIN', 'MANAGER'];

        if(!in_array($profile, $permission)){
            $query = PersonnelRequest::find()->where(['requester_id' => \Yii::$app->user->identity->id]);
        }else{
            $query = PersonnelRequest::find();
        }

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
            'vacancy_quantity' => $this->vacancy_quantity,
            'vacancy_salary' => $this->vacancy_salary,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'requester_id', $this->requester_id])
            ->andFilterWhere(['like', 'vacancy_company', $this->vacancy_company])
            ->andFilterWhere(['like', 'vacancy_office', $this->vacancy_office])
            ->andFilterWhere(['like', 'vacancy_variable', $this->vacancy_variable])
            ->andFilterWhere(['like', 'vacancy_benefits', $this->vacancy_benefits])
            ->andFilterWhere(['like', 'vacancy_type', $this->vacancy_type])
            ->andFilterWhere(['like', 'vacancy_workload', $this->vacancy_workload])
            ->andFilterWhere(['like', 'vacancy_motive', $this->vacancy_motive])
            ->andFilterWhere(['like', 'vacancy_gender', $this->vacancy_gender])
            ->andFilterWhere(['like', 'vacany_confidential', $this->vacany_confidential])
            ->andFilterWhere(['like', 'vacancy_formation', $this->vacancy_formation])
            ->andFilterWhere(['like', 'vacancy_activities', $this->vacancy_activities])
            ->andFilterWhere(['like', 'vacancy_requirements', $this->vacancy_requirements])
            ->andFilterWhere(['like', 'dp_authorization', $this->dp_authorization])
            ->andFilterWhere(['like', 'director_authorization', $this->director_authorization])
            ->andFilterWhere(['like', 'rh_authorization', $this->rh_authorization])
        ->andFilterWhere(['like', 'enterprise.company_name', $this->enterprise]);

        return $dataProvider;
    }
}
