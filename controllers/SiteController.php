<?php

namespace app\controllers;

use Yii;
use yii\base\Component;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $form_activity = ((isset($session['step'])))? 1 : 0;
        return $this->render('index', ['form_activity' => $form_activity]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionSetlang($lng)
    {
        return $this->redirect(Yii::$app->request->referrer);
    }
}
