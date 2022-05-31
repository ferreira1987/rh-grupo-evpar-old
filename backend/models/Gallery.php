<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "media".
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property string|null $type
 * @property string|null $created_at
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'media';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'path'], 'required'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['path'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'path' => 'Caminho',
            'type' => 'Tipo',
            'created_at' => 'Data Envio',
        ];
    }
}
