<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\helpers\UnderMaintenance;
use app\models\user\User;
use app\models\ChangePassword;

class ChangePasswordController extends Controller
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
                            'index'
                        ],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get', 'post']
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

    public function actionIndex($key)
    {
        $this->view->title = 'Change Password';

        $this->layout = false;

        $model = new ChangePassword;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $decode = base64_decode($key);

            $explode = explode(':', $decode);

            $count = count($explode);

            if ($count == 3 && strtotime(date('Y-m-d H:i:s')) < $explode[0]) {
                $user = User::find()->where(['email' => $explode[1]])->one();
                $user->scenario = 'reset-password';

                $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->password);

                if ($user->save()) {
                    Yii::$app->session->setFlash('password-changed', "Your password has been changed. Now you can login with your new password.");

                    return Yii::$app->controller->redirect('/login');
                }
            } else {
                throw new \yii\web\NotFoundHttpException();
            }
        } else {
            $decode = base64_decode($key);

            $explode = explode(':', $decode);

            $count = count($explode);

            if ($count == 3 && strtotime(date('Y-m-d H:i:s')) < $explode[0]) {
                $user = User::find()->where(['email' => $explode[1]])->one();

                if ($user) {
                    return $this->render('index', [
                        'model' => $model
                    ]);
                } else {
                    throw new \yii\web\NotFoundHttpException();
                }
            } else {
                throw new \yii\web\NotFoundHttpException();
            }
        }
    }
}