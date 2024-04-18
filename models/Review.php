<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property string $full_name
 * @property string $phone
 * @property string $text
 * @property string $created_at
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'phone', 'text'], 'required'],
            [['text'], 'string'],
            [['full_name', 'phone'], 'string', 'max' => 255],
            ['full_name', 'match', 'pattern' => '/^([а-яёА-ЯЁ\-]+\s){2}[а-яёА-ЯЁ\-]+$/u'],
            ['phone', 'match', 'pattern' => '/^\+7\(\d{3}\)\-\d{3}(\-\d{2}){2}$/'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'ФИО',
            'phone' => 'Телефон',
            'text' => 'Текст',
            'created_at' => 'Дата содания',
        ];
    }
}
