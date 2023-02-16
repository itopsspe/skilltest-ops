<?php

namespace app\modules\admin\modules\account\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'update'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index'     => ['get'],
                    'update'    => ['get', 'post']
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->view->title = "Profile";

        $model = Yii::$app->user->identity;
        
        return $this->render('index', [
            'model' => $model
        ]);
    }
}
