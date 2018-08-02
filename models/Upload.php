<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class Upload extends Model
{
    /**
     * @var Upload
     */
    public $imageFile;
    public $imageFiles;

    public function attributeLabels()
    {
        return [
            'imageFile' => Yii::t('front-end', 'Your picture'),
            'imageFiles' => Yii::t('front-end', 'Your pictures'),
        ];
    }
    
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 512000, 'tooBig' => Yii::t('front-end', 'Limit is 500KB')],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 0],
        ];
    }
}