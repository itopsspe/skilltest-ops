<?php

namespace app\modules\admin\modules\account\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\user\User;

class ChangePasswordController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
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

    public function actionIndex()
    {
        $this->view->title = "Change Password";

        $model = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
        $model->scenario = 'change-password';
        
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->new_password);

            if ($model->save(false)) {
                Yii::$app->session->setFlash('password-changed', "Your password has been changed. Now you can login with your new password.");
                
                return $this->redirect(Yii::$app->request->referrer);
            }
        } else {
            return $this->render('index', [
                'model' => $model
            ]);
        }
    }
}
