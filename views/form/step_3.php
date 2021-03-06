<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = Yii::t('front-end', 'Form in progress...');
$this->params['breadcrumbs'][] = ['label' => Yii::t('front-end', 'Form'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <div class="users-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'gender')->radioList(['1'=> Yii::t('front-end', 'Male'), '0'=> Yii::t('front-end', 'Female')]); ?>
        
    <div class="form-group">
        <?= Html::submitButton(Yii::t('front-end', 'Next'), ['class' => 'btn btn-success']) ?>
    </div>
        
    <?php ActiveForm::end(); ?>    
</div>
