<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

namespace app\modules\admin\modules\rbac\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\components\rbac\Helper;
use app\components\rbac\Configs;
use app\models\rbac\BizRule;
use app\models\rbac\searchs\BizRule as BizRuleSearch;

class RuleController extends Controller
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->view->title = 'RBAC';

        $searchModel = new BizRuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        $this->view->title = 'RBAC';

        $model = $this->findModel($id);

        return $this->render('view', ['model' => $model]);
    }

    public function actionCreate()
    {
        $this->view->title = 'RBAC';

        $model = new BizRule(null);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Helper::invalidate();

            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('create', ['model' => $model,]);
        }
    }

    public function actionUpdate($id)
    {
        $this->view->title = 'RBAC';
        
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Helper::invalidate();

            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('update', ['model' => $model,]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        Configs::authManager()->remove($model->item);
        
        Helper::invalidate();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        $item = Configs::authManager()->getRule($id);
        
        if ($item) {
            return new BizRule($item);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}