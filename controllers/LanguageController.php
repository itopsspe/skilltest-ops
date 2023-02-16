<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Cookie;

class LanguageController extends Controller
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

    public function actionIndex($language)
    {
        $this->view->title = "Language";

        $this->layout = false;
        
        if ($language) {
            Yii::$app->language = $language;

            $cookie = new Cookie([
                'name' => 'language',
                'value' => $language,
                'expire' => time() + 86400 * 5,
            ]);

            Yii::$app->getResponse()->getCookies()->add($cookie);

            return $this->redirect(Yii::$app->request->referrer);
        }
    }
}