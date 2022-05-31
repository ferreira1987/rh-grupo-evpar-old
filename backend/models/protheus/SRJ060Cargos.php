<?php

namespace backend\models\protheus;

class SRJ060Cargos extends \yii\db\ActiveRecord
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
        return 'dbo.SRJ060';
    }

    public function fields()
    {
        return [
            'R_E_C_N_O_',
            'RJ_FILIAL',
            'RJ_FUNCAO',
            'RJ_DESC'
        ];
    }

}