<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ombudsman".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $logo
 * @property string|null $banner
 * @property string|null $title
 * @property string|null $subtitle
 * @property string|null $email
 * @property string|null $footer_title
 * @property string|null $footer_subtitle
 */
class Ombudsman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ombudsman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'logo', 'banner', 'title', 'subtitle', 'email', 'footer_title', 'footer_subtitle'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'logo' => 'Logo',
            'banner' => 'Banner',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'email' => 'Email',
            'footer_title' => 'Footer Title',
            'footer_subtitle' => 'Footer Subtitle',
        ];
    }
}
