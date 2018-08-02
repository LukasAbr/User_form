<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\UsersSearch;
use app\models\Images;
use app\models\Upload;
use app\models\User2PLang;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\web\Session;
use yii\filters\VerbFilter;
use yii\caching\ArrayCache;
use yii\web\Cookie;

/**
 * FormController implements the CRUD actions for Users model.
 */
class FormController extends Controller
{
    
    private $nextAllowed = 1;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Users();
        $p_lang_model = new User2PLang();
        $upload_model = new Upload();
        
        $session = Yii::$app->session;
        $session['step'] = (!isset($session['step'])) ? 1 : $session['step'];
        
        if (Yii::$app->request->post()) {
            $session['user_data'] = self::getDataForSession(Yii::$app->request->post(), "Users");
            $session['p_lang_data'] = self::getDataForSession(Yii::$app->request->post(), "P_Lang");
            
            if(($session['step'] == 4 && Yii::$app->request->post()["Users"]['interested_in_p'] == 0) || $session['step'] == 6) {
                if($model->load($session['user_data']) && $model->save()){
                    if(isset($session['p_lang_data']['p_lang_id']) && !empty($session['p_lang_data']['p_lang_id'])){
                        self::savePLanguageSelection($model);
                    }
                    if(isset(Yii::$app->request->post()["Upload"]["imageFile"]) && $upload_model->load(Yii::$app->request->post())){
                        self::saveImage($upload_model, $model);
                    }
                    unset($session['step'], $session['user_data'], $session['p_lang_data'], $session['prev_data_key']);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }  else if ($this->nextAllowed) {
                $session['step'] += 1;
            }
        }
        return $this->render('step_'. $session['step'], ['model' => $model, 'upload_model' => $upload_model, 'p_lang_model' => $p_lang_model]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $p_lang_data = User2PLang::getProgrammingLangDataByUserId($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'p_lang_data' => $p_lang_data,
        ]);
    }
    
    /**
     * Get data for specific session to set.
     * @param array $post_data
     * @param string $form_type
     * @return $data
     */
    private function getDataForSession($post_data, $form_type){
        $session = Yii::$app->session;
        switch ($form_type){
            case ('Users'):
                $data = (isset($session['user_data'])) ? $session['user_data'] : [];
                if(isset($post_data["Users"]) && !empty($post_data["Users"])){
                    if(isset($session['prev_data_key']) && $session['prev_data_key'] == key($post_data["Users"])){
                        $this->nextAllowed = 0;
                    }
                    $session['prev_data_key'] = key($post_data["Users"]);
                    $data['Users'][key($post_data["Users"])] = $post_data["Users"][key($post_data["Users"])];
                }
                break;
            case ('P_Lang'):
                $data = (isset($session['p_lang_data'])) ? $session['p_lang_data'] : [];
                if(isset($post_data["User2PLang"]['p_lang_id']) && !empty($post_data["User2PLang"]['p_lang_id']) && $post_data["User2PLang"]['p_lang_id'][0] != 6){
                    if(isset($session['prev_data_key']) && $session['prev_data_key'] == key($post_data["User2PLang"])){
                        $this->nextAllowed = 0;
                    }
                    $session['prev_data_key'] = key($post_data["User2PLang"]);
                    $data = $post_data["User2PLang"];
                }
                break;
        }
        return $data;
    }
    
    /**
     * Save image to file and image path to database.
     * @param object $upload_model
     * @param object $model
     */
    private function saveImage($upload_model, $model){
        $img_model = new Images();
        $image = UploadedFile::getInstance($upload_model, 'imageFile');
        if(!empty($image)){
            $img_model->user_id = $model->id;
            $img_model->img_path = $image->getBaseName().".".$image->getExtension();
            $image->saveAs(Yii::getAlias('@ImgPath').'/'.$image->getBaseName().".".$image->getExtension());
            $img_model->save();
        }
    }
    
    /**
     * Save programming language selection database.
     * @param object $p_lang_model
     * @param object $model
     */
    private function savePLanguageSelection($model){
        $session = Yii::$app->session;
        $p_lang_selections = $session['p_lang_data'];
        foreach($p_lang_selections['p_lang_id'] as $p_lang){
            $p_lang_model = new User2PLang();
            $p_lang_model->user_id = $model->id;
            $p_lang_model->p_lang_id = $p_lang;
            $p_lang_model->save();
        }
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('front-end', 'The requested page does not exist.'));
    }
    
    public function actionYears(){
        $years = array_combine(range(date("Y"), 1900), range(date("Y"), 1900));
        echo json_encode($years);
    }
    
    public function actionDays($year, $month){
        $year = (!empty($year)) ? $year : date("Y");
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        echo json_encode($days);
    }
}
