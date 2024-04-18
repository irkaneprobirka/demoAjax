<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property int $user_id
 * @property int $status_id
 * @property int $category_id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string|null $image_admin
 * @property string|null $reason
 * @property string $created_at
 * @property string $time_delivery
 *
 * @property Category $category
 * @property Status $status
 * @property User $user
 */
class Application extends \yii\db\ActiveRecord
{

    public $imageFile;


    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'description'], 'required'],
            [['user_id', 'status_id', 'category_id'], 'integer'],
            [['title', 'description', 'image', 'image_admin', 'reason'], 'string', 'max' => 255],
            ['time_delivery', 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            ['time_delivery', 'checkDate'],
            ['time_delivery', 'checkTime'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, bmp'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Логин',
            'status_id' => 'Статус',
            'category_id' => 'Категория',
            'title' => 'Название',
            'description' => 'Описание',
            'image' => 'Image',
            'image_admin' => 'Изображение админа',
            'reason' => 'Комментарий',
            'created_at' => 'Дата создание',
            'time_delivery' => 'Дата доставки',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function checkDate(): void
    {
        if ($this->id) {
            $res = self::find()
                ->where(['time_delivery' => $this->time_delivery])
                ->andWhere(['!=', 'id', $this->id])
                ->count();

            if ($res) {
                $this->addError('time_delivery', 'Вы даун');
            }
        }
    }

    public function checkTime(): void
    {
        $hour = (int)Yii::$app->formatter->asTime($this->time_delivery, 'php:H');
        $minute = (int)Yii::$app->formatter->asTime($this->time_delivery, 'php:i');

        if ($hour < 8 || $hour > 12 || !empty($minute)) {
            $this->addError('time_delivery', 'мяу');
        }
    }

    public function upload(string $field = 'image'): bool
    {
        if ($this->validate()) {
            $fileName =
                Yii::$app->user->id
                . "_"
                . time()
                . '.'
                . $this->imageFile->extension;
            $this->imageFile->saveAs('img/' . $fileName);
            $this->$field = $fileName;
            return true;
        } else {
            return false;
        }
    }
}
