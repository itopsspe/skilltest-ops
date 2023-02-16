<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\helpers\UnderMaintenance;
use app\models\user\User;
use app\models\ForgotPassword;

class ForgotPasswordController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'proceed'
                        ],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get', 'post'],
                    'proceed' => ['get']
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (UnderMaintenance::status() == 1) {
            return $this->redirect(['/under-maintenance']);
        }
    
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $this->view->title = 'Forgot Password';
        
        $this->layout = false;

        $model = new ForgotPassword;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $account = User::find()->select(['email'])->where(['email' => $model->email])->one();

            $key = base64_encode(strtotime("+1 hour").':'.$account->email.':'.strtotime("+3 minutes"));

            $url = Url::base(true);
            
            $mail = Yii::$app->mailer->compose('layouts/forgot-password', ['model' => $account, 'key' => $key, 'url' => $url]);

            $mail->setFrom(['official@davidrivaldy.id' => 'David Rivaldy Official'])
            ->setTo($account->email)
            ->setSubject('YII2 - Reset Password')
            ->send();

            return Yii::$app->controller->redirect('/forgot-password/proceed/'.$key);
        } else {
            return $this->render('index', [
                'model' => $model
            ]);
        }
    }

    public function actionProceed($key)
    {
        $this->view->title = 'Forgot Password';
        
        $this->layout = false;

        $decode = base64_decode($key);

        $explode = explode(':', $decode);

        $count = count($explode);

        if ($count == 3 && strtotime(date('Y-m-d H:i:s')) < $explode[2]) {
            return $this->render('proceed');
        } else {
            throw new \yii\web\NotFoundHttpException();
        }
    }
}