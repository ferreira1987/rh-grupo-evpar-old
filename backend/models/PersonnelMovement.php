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
use yii\helpers\VarDumper;

/**
 * This is the model class for table "personnel_movement".
 *
 * @property int $id
 * @property int $requester_id
 * @property string $movement_type
 * @property string|null $change_motive
 * @property string|null $shutdown_motive
 * @property string|null $shutdown_type
 * @property string|null $attachments
 * @property string|null $move_detail
 * @property string|null $requester_authorization
 * @property string|null $director_authorization
 * @property string|null $rh_authorization
 * @property int|null $updated_by
 * @property string $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $user
 */
class PersonnelMovement extends \yii\db\ActiveRecord
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
        return 'personnel_movement';
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
            [['group', 'staff_id', 'staff_company', 'movement_type', 'justification'], 'required', 'message' => 'campo obrigatório'],
            [['requester_id', 'updated_by'], 'integer'],
            [['movement_type', 'change_motive', 'shutdown_motive', 'shutdown_type', 'status'], 'string'],
            [['staff_registry', 'staff_job', 'staff_cc', 'staff_admission', 'movement_type', 'attachments', 'move_detail', 'justification', 'logo', 'created_at', 'updated_at'], 'safe'],
            [['director_authorization', 'rh_authorization', 'dp_authorization'], 'string', 'max' => 60],
            [['staff_job', 'staff_department', 'justification'], 'filter', 'filter'=>'strtoupper'],

            [['change_motive'], 'required', 'when' => function($model){
                return $model->movement_type == 'ALTERACAO';
            }, 'whenClient' => "function (attribute, value) {
                return $('#personnelmovement-movement_type').val() === 'ALTERACAO';
            }"],
            [['shutdown_type', 'shutdown_motive'], 'required', 'when' => function($model){
                return $model->movement_type == 'DESLIGAMENTO';
            }, 'whenClient' => "function (attribute, value) {
                return $('#personnelmovement-movement_type').val() === 'DESLIGAMENTO';
            }"],
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
            'staff_job' => 'Cargo',
            'staff_department' => 'Departamento',
            'staff_group' => 'Grupo Empresarial',
            'staff_company' => 'Empresa',
            'movement_type' => 'Tipo de Movimentação',
            'change_motive' => 'Motivo da Alteração',
            'shutdown_motive' => 'Motivo do Desligamento',
            'shutdown_type' => 'Tipo do Desligamento',
            'attachments' => 'Anexos',
            'move_detail' => 'Movimentações',
            'justification' => 'Justificativa',
            'requester_authorization' => 'Autorização Solicitante',
            'director_authorization' => 'Autorização Diretor',
            'rh_authorization' => 'Autorização Rh',
            'updated_by' => 'Atualizado por',
            'status' => 'Situação',
            'created_at' => 'Data',
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
    
    public function getRh()
    {
        return $this->hasOne(\backend\models\User::class, ['id' => 'rh_authorization']);
    } 
    
    public function getDp()
    {
        return $this->hasOne(\backend\models\User::class, ['id' => 'requester_authorization']);
    }
    
    public function getDirector()
    {
        return $this->hasOne(\backend\models\User::class, ['id' => 'director_authorization']);
    }    

    /**
     * Gets query for [[User]].
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

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        //VarDumper::dump($this->errors, 4, true); die;
        
        if( $this->movement_type == 'ALTERACAO'){
            $this->move_detail = $this->move_detail !== null && gettype($this->move_detail) === 'array'
                ? serialize($this->move_detail)
                : null;
            $this->shutdown_motive = null;
            $this->shutdown_type = null;
        } else {
            $this->change_motive = null;
        }

        $this->attachments = $this->attachments !== null && gettype($this->attachments) === 'array'
            ? serialize($this->attachments)
            : null;
        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->move_detail = $this->move_detail !== null && gettype(unserialize($this->move_detail)) === 'array'
            ? unserialize($this->move_detail)
            : null;
        $this->attachments = $this->attachments !== null && gettype(unserialize($this->attachments)) === 'array'
            ? unserialize($this->attachments)
            : null;
        return true;
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->move_detail = $this->move_detail !== null && gettype(unserialize($this->move_detail)) === 'array'
            ? unserialize($this->move_detail)
            : null;
        $this->attachments = $this->attachments !== null && gettype(unserialize($this->attachments)) === 'array'
            ? unserialize($this->attachments)
            : null;
        return true;
    }
}
