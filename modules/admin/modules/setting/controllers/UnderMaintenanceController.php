<?php

namespace app\modules\admin\modules\setting\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\setting\maintenance\UnderMaintenance;

class UnderMaintenanceController extends Controller
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

    public function actionIndex($status = null)
    {
        $this->view->title = 'Under Maintenance';

        $model = UnderMaintenance::find()->where(['id' => 1])->one();
        
        if ($status == null) {
            return $this->render('index', [
                'model' => $model,
            ]);
        } else {
            if ($status == 1) {
                $model->status = 1;
            } else if ($status == 0) {
                $model->status = 0;
            }

            if ($model->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }
}