<?php
use yii\bootstrap\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?php echo Yii::t('front-end', 'Hello there!') ?></h1>

        <p class="lead"><?php echo Yii::t('front-end', 'Complete form in order for us to gather info about you.') ?></p>
    </div>

    <div class="container">
        <div class="row">
            <?= Html::tag('div', 
                    Html::a( 
                        Html::tag('div',
                            Html::tag('h2', 
                                ($form_activity) ? Yii::t('front-end', 'CONTINUE FORM') 
                                : Yii::t('front-end', 'START FORM'),
                                ['class' => '']
                            ),
                            ['class' => '']
                        ),
                        ['form/index'],
                        ['class'=>'btn btn-lg btn-success']
                    ),
                    ['class'=>'text-center']
                )
            ?>
        </div>
    </div>
</div>
