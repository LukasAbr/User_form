<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\FormAsset;


/* @var $this yii\web\View */
/* @var $model app\models\Users */
FormAsset::register($this);
$this->title = Yii::t('front-end', 'Form in progress...');
$this->params['breadcrumbs'][] = ['label' => Yii::t('front-end', 'Form'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <div class="users-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'birth_date')->hiddenInput(['value' => date('Y')."-01-01"]) ?> 
    <span>
        <select id="years" name="year">
        </select>
    </span>
    <span>
        <select id="months" name="month">
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select> 
    </span>
    <span>
        <select id="days" name="day">
        </select>
    </span>
    <br><br>
        
    <div class="form-group">
        <?= Html::submitButton(Yii::t('front-end', 'Next'), ['class' => 'btn btn-success']) ?>
    </div>
        
    <?php ActiveForm::end(); ?>    
</div>
