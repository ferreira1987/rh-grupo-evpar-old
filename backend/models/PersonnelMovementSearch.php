<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PersonnelMovement;

/**
 * PersonnelMovementSearch represents the model behind the search form of `backend\models\PersonnelMovement`.
 */
class PersonnelMovementSearch extends PersonnelMovement
{
    public $enterprise;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'requester_id', 'updated_by'], 'integer'],
            [['status', 'enterprise', 'staff_id', 'movement_type', 'change_motive', 'shutdown_motive', 'shutdown_type', 'attachments', 'move_detail', 'director_authorization', 'rh_authorization', 'dp_authorization', 'created_at', 'updated_at'], 'safe'],
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
            $query = PersonnelMovement::find()->where(['requester_id' => \Yii::$app->user->identity->id])->with('enterprise');
        }else{
            $query = PersonnelMovement::find()->with('enterprise');
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
            'requester_id' => $this->requester_id,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'movement_type', $this->movement_type])
            ->andFilterWhere(['like', 'staff_id', $this->staff_id])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'change_motive', $this->change_motive])
            ->andFilterWhere(['like', 'shutdown_motive', $this->shutdown_motive])
            ->andFilterWhere(['like', 'shutdown_type', $this->shutdown_type])
            ->andFilterWhere(['like', 'attachments', $this->attachments])
            ->andFilterWhere(['like', 'move_detail', $this->move_detail])
            ->andFilterWhere(['like', 'dp_authorization', $this->dp_authorization])
            ->andFilterWhere(['like', 'director_authorization', $this->director_authorization])
            ->andFilterWhere(['like', 'rh_authorization', $this->rh_authorization])
            ->andFilterWhere(['like', 'enterprise.company_name', $this->enterprise])
            ->andFilterWhere(['like', 'created_at', $this->created_at]);

        return $dataProvider;
    }
}
