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
use app\models\rbac\Assignment;
use app\models\rbac\searchs\Assignment as AssignmentSearch;

class AssignmentController extends Controller
{
    public $userClassName;
    public $idField = 'id';
    public $emailField = 'email';
    public $fullnameField;
    public $searchClass;
    public $extraColumns = [];

    public function init()
    {
        parent::init();
        
        if ($this->userClassName === null) {
            $this->userClassName = Yii::$app->getUser()->identityClass;
            
            $this->userClassName = $this->userClassName ? : 'app\models\membership\account\Account';
        }
    }

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
                    'assign' => ['post'],
                    'assign' => ['post'],
                    'revoke' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->view->title = Yii::t('app', 'assignment');

        if ($this->searchClass === null) {
            $searchModel = new AssignmentSearch;

            $dataProvider = $searchModel->search(Yii::$app->getRequest()->getQueryParams(), $this->userClassName, $this->emailField);
        } else {
            $class = $this->searchClass;
            
            $searchModel = new $class;
            
            $dataProvider = $searchModel->search(Yii::$app->getRequest()->getQueryParams());
        }

        return $this->render('index', [
            'dataProvider'  => $dataProvider,
            'searchModel'   => $searchModel,
            'idField'       => $this->idField,
            'emailField'    => $this->emailField,
            'extraColumns'  => $this->extraColumns,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model'         => $model,
            'idField'       => $this->idField,
            'emailField'    => $this->emailField,
            'fullnameField' => $this->fullnameField,
        ]);
    }

    public function actionAssign($id)
    {
        $items = Yii::$app->getRequest()->post('items', []);

        $model = new Assignment($id);

        $success = $model->assign($items);

        Yii::$app->getResponse()->format = 'json';

        return array_merge($model->getItems(), ['success' => $success]);
    }

    public function actionRevoke($id)
    {
        $items = Yii::$app->getRequest()->post('items', []);

        $model = new Assignment($id);

        $success = $model->revoke($items);

        Yii::$app->getResponse()->format = 'json';

        return array_merge($model->getItems(), ['success' => $success]);
    }

    protected function findModel($id)
    {
        $class = $this->userClassName;

        if (($user = $class::findIdentity($id)) !== null) {
            return new Assignment($id, $user);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}