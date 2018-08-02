<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user2p_lang".
 *
 * @property int $id
 * @property int $user_id
 * @property int $p_lang_id
 */
class User2PLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user2p_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'p_lang_id'], 'safe'],
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
            'p_lang_id' => Yii::t('front-end', 'What programming languages do you know?'),
        ];
    }
    
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['id' => 'user_id']);
    }
    
    public function getProgrammingLangDataByUserId($user_id){
        return User2PLang::find()
                ->select("*")
                ->leftJoin('p_lang', 'p_lang.id=user2p_lang.p_lang_id')
                ->where(['=', 'user2p_lang.user_id', $user_id])
                ->asArray()
                ->all();
    }
}
