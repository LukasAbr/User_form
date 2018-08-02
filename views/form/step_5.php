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
    
    <?= $form->field($p_lang_model, 'p_lang_id[]')->checkboxList(
        ['1' => 'PHP', '2' => 'CSS', '3' => 'HTML', '4' => 'JavaScript', '5' => 'JAVA', '6' => Yii::t('front-end', 'Dont know any of these')]
    ); ?>
        
    <div class="form-group">
        <?= Html::submitButton(Yii::t('front-end', 'Next'), ['class' => 'btn btn-success']) ?>
    </div>
        
    <?php ActiveForm::end(); ?>    
</div>
