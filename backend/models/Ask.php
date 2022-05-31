<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ask".
 *
 * @property int $id
 * @property string|null $ask
 * @property string|null $group
 * @property string|null $options
 */
class Ask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shutdown_ask';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['options'], 'string'],
            [['ask'], 'string', 'max' => 255],
            [['group'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ask' => 'Ask',
            'group' => 'Group',
            'options' => 'Options',
        ];
    }
}
