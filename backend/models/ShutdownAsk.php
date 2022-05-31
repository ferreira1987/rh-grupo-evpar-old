<?php

namespace backend\models;

use backend\models\protheus\SRA010Funcionario;
use backend\models\protheus\SRA020Funcionario;
use backend\models\protheus\SRA040Funcionario;
use backend\models\protheus\SRA050Funcionario;
use backend\models\protheus\SRA060Funcionario;
use backend\models\protheus\SRJ010Cargos;
use backend\models\protheus\SRJ020Cargos;
use backend\models\protheus\SRJ040Cargos;
use backend\models\protheus\SRJ050Cargos;
use backend\models\protheus\SRJ060Cargos;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use backend\models\Ask;
use yii\db\Expression;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "shutdown_ask".
 *
 * @property int $id
 * @property string|null $staff_registry
 * @property string $staff_id
 * @property int $staff_company
 * @property string $staff_job
 * @property string|null $staff_department
 * @property string|null $shutdown_date
 * @property string|null $company_time
 * @property string|null $shutdown_motive
 * @property string|null $shutdown_initiative
 * @property array|string|null $admission_period
 * @property string|null $acting_period
 * @property string|null $dismissal_period
 * @property string|null $categories
 * @property string|null $interview_type
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Enterprise $enterprise
 * @property Ask $ask
 */
class ShutdownAsk extends \yii\db\ActiveRecord
{
    public $group;
    public $staff_cc;
    public $staff_job;
    public $staff_registry;
    public $staff_admission;
    public $logo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shutdown_form';
    }

    public function behaviors()
    {
        return [
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
            [['group', 'staff_id', 'staff_company'], 'required', 'message' => 'campo obrigatório'],
            [['staff_company', 'created_by', 'updated_by'], 'integer'],
            [['logo', 'staff_job', 'staff_admission', 'staff_cc', 'prevent_shutdown_ask', 'shutdown_date', 'shutdown_motive', 'admission_period', 'shutdown_initiative', 'acting_period', 'dismissal_period', 'categories', 'interview_type', 'created_at', 'updated_at'], 'safe'],
            [['staff_registry', 'staff_job', 'staff_department', 'company_time'], 'string', 'max' => 100],
            [['staff_company', 'staff_job', 'staff_department'], 'filter', 'filter'=>'strtoupper']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'staff_registry' => 'Matrícula',
            'staff_id' => 'Nome',
            'staff_company' => 'Empresa ID',
            'staff_admission' => 'Admissão',
            'staff_cc' => 'Centro de Custo',
            'staff_job' => 'Cargo',
            'staff_department' => 'Departamento/Setor',
            'staff_branch' => 'Filial',
            'shutdown_date' => 'Data de Desligamento',
            'prevent_shutdown_ask' => 'O que teria evitado seu desligamento',
            'company_time' => 'Tempo de Empresa',
            'shutdown_motive' => 'Motivo do Desligamento',
            'shutdown_initiative' => 'Iniciativa do Desligamento',
            'admission_period' => 'Processo Admissional',
            'acting_period' => 'Período de Atuação',
            'dismissal_period' => 'Processo Demissional',
            'categories' => 'Categorias',
            'interview_type' => 'Tipo da Entrevista',
            'created_by' => 'Criado por',
            'updated_by' => 'Atualizado por',
            'created_at' => 'Criado',
            'updated_at' => 'Atualizado',
        ];
    }

    /**
     * Gets query for [[Enterprise]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnterprise()
    {
        return $this->hasOne(Enterprise::class, ['id' => 'staff_company']);
    }

    /**
     * Gets query for [[Ask]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsk()
    {
        return $this->hasOne(Ask::class, ['id' => 'staff_company']);
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        $query = null;
        switch($this->enterprise->group_id) :
            case '01';
                $query = $this->hasOne(SRA010Funcionario::class, ['R_E_C_N_O_' => 'staff_id']);
                break;
            case '02';
                $query = $this->hasOne(SRA020Funcionario::class, ['R_E_C_N_O_' => 'staff_id']);
                break;
            case '04';
                $query = $this->hasOne(SRA040Funcionario::class, ['R_E_C_N_O_' => 'staff_id']);
                break;
            case '05';
                $query = $this->hasOne(SRA050Funcionario::class, ['R_E_C_N_O_' => 'staff_id']);
                break;
            case '06';
                $query = $this->hasOne(SRA060Funcionario::class, ['R_E_C_N_O_' => 'staff_id']);
                break;
        endswitch;

        return $query;
    }

    /**
     * Gets query for [[Job]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        $query = null;
        switch($this->enterprise->group_id) :
            case '01';
                $query = $this->hasOne(SRJ010Cargos::class, ['R_E_C_N_O_' => 'staff_job']);
                break;
            case '02';
                $query = $this->hasOne(SRJ020Cargos::class, ['R_E_C_N_O_' => 'staff_job']);
                break;
            case '04';
                $query = $this->hasOne(SRJ040Cargos::class, ['R_E_C_N_O_' => 'staff_job']);
                break;
            case '05';
                $query = $this->hasOne(SRJ050Cargos::class, ['R_E_C_N_O_' => 'staff_job']);
                break;
            case '06';
                $query = $this->hasOne(SRJ060Cargos::class, ['R_E_C_N_O_' => 'staff_job']);
                break;
        endswitch;

        return $query;
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        $this->shutdown_motive = $this->shutdown_motive !== null && gettype($this->shutdown_motive) === 'array'
            ? serialize($this->shutdown_motive)
            : null;
        $this->admission_period = $this->admission_period !== null && gettype($this->admission_period) === 'array'
            ? serialize($this->admission_period)
            : null;
        $this->acting_period = $this->acting_period !== null && gettype($this->acting_period) === 'array'
            ? serialize($this->acting_period)
            : null;
        $this->dismissal_period = $this->dismissal_period !== null && gettype($this->dismissal_period) === 'array'
            ? serialize($this->dismissal_period)
            : null;
        $this->categories = $this->categories !== null && gettype($this->categories) === 'array'
            ? serialize($this->categories)
            : null;
        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->shutdown_motive = $this->shutdown_motive !== null && gettype(unserialize($this->shutdown_motive)) === 'array'
            ? unserialize($this->shutdown_motive)
            : null;
        $this->admission_period = $this->admission_period !== null && gettype(unserialize($this->admission_period)) === 'array'
            ? unserialize($this->admission_period)
            : null;
        $this->acting_period = $this->acting_period !== null && gettype(unserialize($this->acting_period)) === 'array'
            ? unserialize($this->acting_period)
            : null;
        $this->dismissal_period = $this->dismissal_period !== null && gettype(unserialize($this->dismissal_period)) === 'array'
            ? unserialize($this->dismissal_period)
            : null;
        $this->categories = $this->categories !== null && gettype(unserialize($this->categories)) === 'array'
            ? unserialize($this->categories)
            : null;
        return true;
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->shutdown_motive = $this->shutdown_motive !== '' && gettype(unserialize($this->shutdown_motive)) === 'array'
            ? unserialize($this->shutdown_motive)
            : null;
        $this->admission_period = $this->admission_period !== '' && gettype(unserialize($this->admission_period)) === 'array'
            ? unserialize($this->admission_period)
            : null;
        $this->acting_period = $this->acting_period !== '' && gettype(unserialize($this->acting_period)) === 'array'
            ? unserialize($this->acting_period)
            : null;
        $this->dismissal_period = $this->dismissal_period !== '' && gettype(unserialize($this->dismissal_period)) === 'array'
            ? unserialize($this->dismissal_period)
            : null;
        $this->categories = $this->categories !== '' && gettype(unserialize($this->categories)) === 'array'
            ? unserialize($this->categories)
            : null;
        return true;
    }
}
