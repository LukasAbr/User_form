<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('front-end', 'Form'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php
    
    $data[] = [
            'attribute'=> Yii::t('front-end', 'Name'),
            'value'=> $model->name,
        ];
    
    $data[] = [
            'attribute'=> Yii::t('front-end', 'Birth Date'),
            'value'=> $model->birth_date,
        ];
    
    $data[] = [
            'attribute'=> Yii::t('front-end', 'Gender'),
            'value'=> ($model->gender) ?  Yii::t('front-end', 'Male') :  Yii::t('front-end', 'Female'),
        ];
    
    $data[] = [
            'attribute'=> Yii::t('front-end', 'Intrested In Programming'),
            'value'=> ($model->interested_in_p) ?  Yii::t('front-end', 'Yes') :  Yii::t('front-end', 'No'),
        ];
    if(!empty($p_lang_data)){
        $data[] = [
            'attribute'=> Yii::t('front-end', 'Programming Languages'),
            'value'=> implode(", ",array_column($p_lang_data, 'title')),
        ];
    }
    
    if(!empty($model->images)){
        $data[] = [
            'attribute'=> Yii::t('front-end', 'Your Image'),
            'value'=> Yii::getAlias('@ImgUrl').'/'.$model->images->img_path,
            'format'=>['image',['width'=>300, 'max_height'=>600,]],
        ];
    }
    
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => $data
    ]) ?>

</div>
