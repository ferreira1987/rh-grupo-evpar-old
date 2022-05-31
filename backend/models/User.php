<?php

namespace backend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 * @property string $full_name
 * @property string $company_id
 * @property string $office
 * @property string $department
 * @property string|null $cost_center
 * @property string|null $unit
 * @property string $direct_responsible
 * @property string|null $phone
 * @property string|null $reset_password
 *
 */
class User extends \common\models\User
{
    public $reset_password;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
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
            [['username', 'email', 'profile', 'full_name', 'company_id', 'office', 'department', 'direct_responsible'], 'required'],
            [['company_id', 'status'], 'integer'],
            [['username', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['full_name', 'office', 'department', 'direct_responsible'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 15],
            [['password_hash'], 'string', 'max' => 8],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['reset_password', 'created_at', 'updated_at'], 'safe'],
            [['password_reset_token'], 'unique'],
            [['username', 'email'], 'filter', 'filter' => 'strtolower'],
            [['full_name', 'office', 'department', 'direct_responsible'], 'filter', 'filter' => 'strtoupper'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'registry' => 'Matrícula',
            'username' => 'Usuário',
            'full_name' => 'Nome Completo',
            'email' => 'Email',
            'phone' => 'Telefone',
            'status' => 'Status',
            'profile' => 'Perfil',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Senha',
            'company_id' => 'Empresa',
            'office' => 'Cargo',
            'department' => 'Departamento',
            'direct_responsible' => 'Responsável direto',
            'password_reset_token' => 'Token de Recuperação',
            'verification_token' => 'Token de Verificação',
            'updated_at' => 'Atualizado',
            'created_at' => 'Criado',
            'reset_password' => 'Resetar Senha'
        ];
    }

    public function  fields()
    {
        $fields = parent::fields();
        unset($fields['auth_key'], $fields['password_hash'], $fields['password_reset_token']);
        return [
            'id',
            'registry',
            'username',
            'full_name',
            'email',
            'phone',
            'company_id',
            'office',
            'department',
            'direct_responsible',
            'profile'
        ];
    }

    /**
     * Gets query for [[Enterprise]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnterprise()
    {
        return $this->hasOne(Enterprise::className(), ['id' => 'company_id']);
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        if($this->isNewRecord){
            $this->password_hash = Yii::$app->security->generatePasswordHash($this->password_hash);
            $this->auth_key = Yii::$app->security->generateRandomString();
        }
        else{
            if($this->reset_password !== ''){
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->reset_password);
            }
            /*if($this->oldAttributes['password_hash'] !== $this->password_hash){
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->password_hash);
            }*/
        }
        return true;
    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub
        unset($this->auth_key, $this->password_hash, $this->password_reset_token);
    }
}
