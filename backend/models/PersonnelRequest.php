<?php

namespace backend\models;

use Yii;
use common\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "request_form".
 *
 * @property int $id
 * @property int|null $requester_id
 * @property int|null $vacancy_company
 * @property string|null $office
 * @property string|null $department
 * @property string|null $cost_center
 * @property string|null $company
 * @property string|null $unit
 * @property string|null $direct_responsible
 * @property string|null $vacancy_office
 * @property int|null $vacancy_quantity
 * @property float|null $vacancy_salary
 * @property string|null $vacancy_variable
 * @property string|null $vacancy_benefits
 * @property string|null $vacancy_type
 * @property string|null $vacancy_workload
 * @property string|null $vacancy_motive
 * @property string|null $vacancy_gender
 * @property string|null $vacany_confidential
 * @property string|null $vacancy_formation
 * @property string|null $vacancy_activities
 * @property string|null $vacancy_requirements
 * @property string|null $vacancy_comments
 * @property string|null $requester_authorization
 * @property string|null $director_authorization
 * @property string|null $rh_authorization
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $user
 * @property Enterprise $enterprise
 */
class PersonnelRequest extends \yii\db\ActiveRecord
{
    public $group;
    public $logo;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personnel_request';
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'requester_id',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group', 'vacancy_company', 'vacancy_office', 'vacancy_quantity', 'vacancy_salary', 'vacancy_type', 'vacancy_workload', 'vacancy_gender', 'vacany_confidential', 'vacancy_formation', 'vacancy_department'], 'required', 'message' => 'campo obrigatório'],
            [['requester_id', 'vacancy_company', 'vacancy_quantity', 'updated_by'], 'integer', 'message' => 'deve ser numérico'],
            [['vacancy_salary'], 'number', 'message' => 'deve ser numérico'],
            [['vacancy_activities', 'vacancy_requirements', 'vacancy_comments'], 'string'],
            [['logo', 'created_at', 'updated_at', 'vacancy_benefits'], 'safe'],
            [['vacancy_office', 'vacancy_motive', 'vacancy_workload',], 'string', 'max' => 120],
            [['vacancy_variable', 'vacancy_formation', 'dp_authorization', 'director_authorization', 'rh_authorization'], 'string', 'max' => 60],
            [['vacancy_type', 'vacancy_gender', 'vacany_confidential', 'vacancy_department'], 'string', 'max' => 45],
            [['vacancy_office', 'vacancy_motive', 'vacancy_activities', 'vacancy_requirements', 'vacancy_comments'], 'filter', 'filter'=>'strtoupper'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'requester_id' => 'Solicitante',
            'vacancy_company' => 'Empresa',
            'vacancy_office' => 'Cargo',
            'vacancy_quantity' => 'Vagas',
            'vacancy_salary' => 'Salário',
            'vacancy_variable' => 'Variável',
            'vacancy_benefits' => 'Benefícios',
            'vacancy_type' => 'Tipo',
            'vacancy_workload' => 'Período',
            'vacancy_motive' => 'Justificativa da Solicitação',
            'vacancy_gender' => 'Gênero',
            'vacany_confidential' => 'Confidencial',
            'vacancy_formation' => 'Formação',
            'vacancy_activities' => 'Atividades a Desempenhar',
            'vacancy_requirements' => 'Requisitos da Vaga',
            'vacancy_comments' => 'Outras Observações',
            'vacancy_department' => 'Departamento',
            'dp_authorization' => 'DP Authorization',
            'director_authorization' => 'Director Authorization',
            'rh_authorization' => 'Rh Authorization',
            'updated_by' => 'Editor',
            'created_at' => 'Cadastro',
            'updated_at' => 'Atualizado',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\backend\models\User::class, ['id' => 'requester_id'])->with('enterprise');
    }

    public function getRh()
    {
        return $this->hasOne(\backend\models\User::class, ['id' => 'rh_authorization']);
    } 
    
    public function getDp()
    {
        return $this->hasOne(\backend\models\User::class, ['id' => 'dp_authorization']);
    }
    
    public function getDirector()
    {
        return $this->hasOne(\backend\models\User::class, ['id' => 'director_authorization']);
    }     

    /**
     * Gets query for [[Enterprise]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnterprise()
    {
        return $this->hasOne(Enterprise::class, ['id' => 'vacancy_company']);
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        $this->vacancy_benefits = $this->vacancy_benefits !== null && gettype($this->vacancy_benefits) === 'array'
            ? serialize($this->vacancy_benefits)
            : null;
        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->vacancy_benefits = $this->vacancy_benefits !== null && gettype(unserialize($this->vacancy_benefits)) === 'array'
            ? unserialize($this->vacancy_benefits)
            : null;
        return true;
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->vacancy_benefits = $this->vacancy_benefits !== null && gettype(unserialize($this->vacancy_benefits)) === 'array'
            ? unserialize($this->vacancy_benefits)
            : null;
        return true;
    }
}
