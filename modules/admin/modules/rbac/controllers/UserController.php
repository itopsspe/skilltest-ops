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
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\user\User;
use app\models\user\UserSearch;

class UserController extends Controller
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
                            'detail',
                            'create',
                            'update',
                            'delete'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index'  => ['get'],
                    'detail' => ['get'],
                    'create' => ['get', 'post'],
                    'update' => ['get', 'post'],
                    'delete' => ['get', 'post']
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->view->title = 'User';

        $searchModel = new UserSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['last_login_datetime' => SORT_DESC]);
        
        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider
        ]);
    }

    public function actionDetail($id)
    {
        return $this->renderAjax('detail', [
            'model' => User::find()->where(['id' => $id])->one(),
        ]);
    }

    public function actionCreate()
    {
        $this->view->title = Yii::t('app', 'create');

        $model = new User;
        $model->scenario = 'insert-account';

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->setAttributes([
                'name'          => ucwords(strtolower($model->name)),
                'username'      => strtolower($model->username),
                'email'         => strtolower($model->email),
                'password_hash' => Yii::$app->getSecurity()->generatePasswordHash($model->new_password)
            ]);

            if ($model->save()) {
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
        $model->scenario = 'update-account';

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post())) {
            $password = trim($model->new_password) ? Yii::$app->getSecurity()->generatePasswordHash($model->new_password) : $model->password_hash;

            $model->setAttributes([
                'name'          => ucwords(strtolower($model->name)),
                'username'      => strtolower($model->username),
                'email'         => strtolower($model->email),
                'password_hash' => $password
            ]);

            if ($model->save()) {        
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
        
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}