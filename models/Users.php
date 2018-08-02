<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $birth_date
 * @property int $gender
 * @property int $interested_in_p
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gender', 'interested_in_p'], 'integer'],
            [['interested_in_p', 'gender', 'name', 'birth_date'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('front-end', 'ID'),
            'name' => Yii::t('front-end', 'Whats your name?'),
            'birth_date' => Yii::t('front-end', 'Your birth date:'),
            'gender' => Yii::t('front-end', 'Your gender:'),
            'interested_in_p' => Yii::t('front-end', 'Are you interested in programming?'),
        ];
    }
    
    public function beforeSave($insert) {
        if ($insert) {
            $this->birth_date = date('Y-m-d', strtotime($this->birth_date));
        }
        return parent::beforeSave($insert);
    }
    
    public function getUser2PLang()
    {
        return $this->hasMany(User2PLang::className(), ['user_id' => 'id']);
    }
    
    public function getImages()
    {
        return $this->hasOne(Images::className(), ['user_id' => 'id']);
    }
}
