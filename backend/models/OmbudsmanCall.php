<?php

namespace backend\models;

use Yii;
use backend\models\Ombudsman;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "ombudsman_call".
 *
 * @property int $id
 * @property int|null $ombudsman_id
 * @property string $contact_type
 * @property int|null $anonymity
 * @property string $department
 * @property string $name
 * @property string $state
 * @property string $city
 * @property string $job
 * @property string $email
 * @property string $phone
 * @property string $leader
 * @property string $message
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class OmbudsmanCall extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ombudsman_call';
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
            [['ombudsman_id', 'anonymity'], 'integer'],
            [['contact_type', 'department', 'name', 'state', 'city', 'job', 'email', 'phone', 'leader', 'message'], 'required'],
            [['contact_type', 'message'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['department', 'name', 'state', 'city', 'job', 'email', 'phone', 'leader'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ombudsman_id' => 'Ouvidoria',
            'contact_type' => 'Tipo Contato',
            'anonymity' => 'Anônimo?',
            'department' => 'Departamento',
            'name' => 'Nome',
            'state' => 'Estado',
            'city' => 'Cidade',
            'job' => 'Cargo',
            'email' => 'Email',
            'phone' => 'Telefone',
            'leader' => 'Chefe/Gestor',
            'message' => 'Mensagem',
            'created_at' => 'Data',
            'updated_at' => 'Atualizado',
        ];
    }

    public function getOmbudsman()
    {
        return $this->hasOne(Ombudsman::class, ['id' => 'ombudsman_id']);
    }

    public function formName()
    {
        return 'OmbudsmanController';
    }
}
