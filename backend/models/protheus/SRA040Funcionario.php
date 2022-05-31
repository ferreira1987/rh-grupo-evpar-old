<?php

namespace backend\models\protheus;

class SRA040Funcionario extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db1;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dbo.SRA040';
    }

    public function rules()
    {
        return [
            [['RA_FILIAL', 'RA_CC', 'RA_MAT', 'RA_NOME', 'RA_SEXO', 'RA_NASC', 'RA_ADMISSA', 'RA_SITFOLH', 'RA_CODFUNC', 'RA_TPCONTR', 'RA_DEPART', 'RA_TELEFON', 'RA_GESTOR'], 'safe']
        ];
    }

    public function fields()
    {
        return [
            'RA_FILIAL', 'RA_CC', 'RA_MAT', 'RA_NOME', 'RA_SEXO', 'RA_NASC', 'RA_ADMISSA', 'RA_SITFOLH', 'RA_CODFUNC', 'RA_TPCONTR', 'RA_DEPART', 'RA_TELEFON', 'RA_GESTOR', 'CARGO' => 'job'
        ];
    }

    public function getJob()
    {
        return $this->hasOne(SRJ040Cargos::class, ['RJ_FUNCAO' => 'RA_CODFUNC']);
    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub
        $this->RA_ADMISSA = date_format(date_create($this->RA_ADMISSA), 'Y-m-d h:i:s');

        return true;
    }

}