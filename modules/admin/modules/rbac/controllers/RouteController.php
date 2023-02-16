<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

namespace app\modules\admin\modules\rbac\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\rbac\Route;

class RouteController extends Controller
{
    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create'    => ['post'],
                    'assign'    => ['post'],
                    'remove'    => ['post'],
                    'refresh'   => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->view->title = Yii::t('app', 'route');

        $model = new Route();

        return $this->render('index', ['routes' => $model->getRoutes()]);
    }

    public function actionCreate()
    {
        $this->view->title = Yii::t('app', 'create');
        
        Yii::$app->getResponse()->format = 'json';
        
        $routes = Yii::$app->getRequest()->post('route', '');
        
        $routes = preg_split('/\s*,\s*/', trim($routes), -1, PREG_SPLIT_NO_EMPTY);
        
        $model = new Route();
        
        $model->addNew($routes);
        
        return $model->getRoutes();
    }

    public function actionAssign()
    {
        $routes = Yii::$app->getRequest()->post('routes', []);
        
        $model = new Route();
        
        $model->addNew($routes);
        
        Yii::$app->getResponse()->format = 'json';
        
        return $model->getRoutes();
    }

    public function actionRemove()
    {
        $routes = Yii::$app->getRequest()->post('routes', []);
        
        $model = new Route();
        
        $model->remove($routes);
        
        Yii::$app->getResponse()->format = 'json';
        
        return $model->getRoutes();
    }

    public function actionRefresh()
    {
        $model = new Route();
        
        $model->invalidate();
        
        Yii::$app->getResponse()->format = 'json';
        
        return $model->getRoutes();
    }
}