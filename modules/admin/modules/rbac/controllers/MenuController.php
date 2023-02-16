<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

namespace app\modules\admin\modules\rbac\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\components\rbac\Helper;
use app\models\rbac\Menu;
use app\models\rbac\searchs\Menu as MenuSearch;

class MenuController extends Controller
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
                            'create',
                            'update',
                            'delete',
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
                    'create'    => ['get', 'post'],
                    'update'    => ['get', 'post'],
                    'delete'    => ['post']
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->view->title = Yii::t('app', 'menu');

        $searchModel = new MenuSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionCreate()
    {
        $this->view->title = Yii::t('app', 'create');

        $model = new Menu;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->route == '/#') {
                $model->route = '';
            }

            if ($model->save()) {
                Helper::invalidate();
            
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                    'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $this->view->title = Yii::t('app', 'update');
        
        $model = $this->findModel($id);
        
        if ($model->menuParent) {
            $model->parent_name = $model->menuParent->name;
        }
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->route == '/#') {
                $model->route = '';
            }

            if ($model->save()) {
                Helper::invalidate();
            
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        Helper::invalidate();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}