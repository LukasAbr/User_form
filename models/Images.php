<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property int $user_id
 * @property string $img_path
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['img_path'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('front-end', 'ID'),
            'user_id' => Yii::t('front-end', 'User ID'),
            'img_path' => Yii::t('front-end', 'Img Path'),
        ];
    }
    
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
