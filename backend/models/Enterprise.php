<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "enterprise".
 *
 * @property int $id
 * @property string $group_id
 * @property string $group_name
 * @property string $company_id
 * @property string $company_name
 * @property string|null $cnpj
 */
class Enterprise extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enterprise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'group_name', 'company_id', 'company_name'], 'required'],
            [['group_id', 'group_name', 'company_id', 'company_name', 'cnpj'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'group_name' => 'Group Name',
            'company_id' => 'Company ID',
            'company_name' => 'Company Name',
            'cnpj' => 'Cnpj',
        ];
    }

    public function  fields()
    {
        return [
            'id',
            'group_id',
            'group_name',
            'company_id',
            'company_name',
            'cnpj',
        ];
    }
}
