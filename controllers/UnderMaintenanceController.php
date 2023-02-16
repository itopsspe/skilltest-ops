<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\helpers\UnderMaintenance;

class UnderMaintenanceController extends Controller
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
                    'index' => ['get']
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (UnderMaintenance::status() == 0) {
            return $this->redirect(['/']);
        }
    
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $this->layout = 'under-maintenance';
        
        return $this->render('index');
    }
}