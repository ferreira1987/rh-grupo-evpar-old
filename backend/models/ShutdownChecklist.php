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
use yii\db\Expression;

/**
 * This is the model class for table "shutdown_checklist".
 *
 * @property int $id
 * @property int|null $requester_id
 * @property string|null $staff_registry
 * @property string $staff_name
 * @property int $staff_company
 * @property string $staff_job
 * @property string|null $staff_department
 * @property string|null $staff_branch
 * @property string|null $dp_authorization
 * @property string|null $director_authorization
 * @property string|null $rh_authorization
 * @property string|null $shutdown_motive
 * @property string|null $e1_interview
 * @property string|null $e1_dental_plan
 * @property string|null $e1_health_plan
 * @property string|null $e1_date
 * @property string|null $e2_early_warning
 * @property string|null $e2_date
 * @property string|null $e3_access_blocking
 * @property string|null $e3_return_equipment
 * @property string|null $e3_date
 * @property string|null $e4_return_vehicle
 * @property string|null $e4_date
 * @property string|null $e5_return_tools
 * @property string|null $e5_date
 * @property string|null $e6_return_epis
 * @property string|null $e6_return_uniform
 * @property string|null $e6_date
 * @property string|null $e7_aso_dismissal
 * @property string|null $e7_homologation
 * @property string|null $e7_date
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $user
 * @property Enterprise $enterprise
 */
class ShutdownChecklist extends \yii\db\ActiveRecord
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
        return 'shutdown_checklist';
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
            [['requester_id', 'staff_id', 'staff_company', 'updated_by'], 'integer'],
            [['group', 'staff_id', 'staff_company', 'staff_job'], 'required'],
            [['logo', 'staff_registry', 'staff_cc', 'staff_admission', 'staff_job', 'staff_department', 'e1_date', 'e2_date', 'e3_date', 'e4_date', 'e5_date', 'e6_date', 'e7_date', 'created_at', 'updated_at'], 'safe'],
            [['shutdown_motive', 'e1_interview', 'e1_dental_plan', 'e1_health_plan', 'e2_early_warning', 'e3_access_blocking', 'e3_return_equipment', 'e4_return_vehicle', 'e5_return_tools', 'e6_return_epis', 'e6_return_uniform', 'e7_aso_dismissal', 'e7_homologation'], 'string', 'max' => 100],
            [['dp_authorization', 'director_authorization', 'rh_authorization'], 'string', 'max' => 60],
            [['staff_company', 'staff_job'], 'filter', 'filter'=>'strtoupper']
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
            'staff_id' => 'Funcionário',
            'staff_registry' => 'Matrícula',
            'staff_admission' => 'Admissão',
            'staff_cc' => 'Centro de Custo',
            'group' => 'Grupo Empresarial',
            'staff_company' => 'Empresa',
            'enterprise' => 'Empresa',
            'staff_job' => 'Cargo',
            'staff_department' => 'Departamento',
            'shutdown_motive' => 'Motivo do Desligamento',
            'e1_interview' => 'Entrevista de Desligamento',
            'e1_dental_plan' => 'Plano Odontológico',
            'e1_health_plan' => 'Plano de Saúde',
            'e1_date' => 'Data',
            'e2_early_warning' => 'Aviso Prévio',
            'e2_date' => 'Data',
            'e3_access_blocking' => 'Bloquear Acessos',
            'e3_return_equipment' => 'Devolução de Equipamentos',
            'e3_date' => 'Data',
            'e4_return_vehicle' => 'Devoluçao de Veiculo',
            'e4_date' => 'Data',
            'e5_return_tools' => 'Devoluçao de Ferramentas',
            'e5_date' => 'Data',
            'e6_return_epis' => 'Devoluçao de EPI´s',
            'e6_return_uniform' => 'Devoluçao de Uniforme',
            'e6_date' => 'Data',
            'e7_aso_dismissal' => 'ASO Demissional',
            'e7_homologation' => 'Homologaçao',
            'e7_date' => 'Data',
            'dp_authorization' => 'Autorizaçao DP',
            'rh_authorization' => 'Autorizaçao RH',
            'director_authorization' => 'Autorizaçao Diretor',
            'updated_by' => 'Atualizado por',
            'created_at' => 'Criado',
            'updated_at' => 'Atualizado',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'requester_id'])->with('enterprise');
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
}
