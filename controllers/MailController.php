<?php

namespace app\controllers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

class MailController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['register'],
                'rules' => [
                    [
                        'actions' => [
                            'register'
                        ],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'register' => ['get']
                ],
            ],
        ];
    }

    public function actionRegister()
    {
        $this->view->title = "Register";
        $this->layout = false;

        return $this->render('register');
    }

    public function actionForgotPassword()
    {
        $this->view->title = "Forgot Password";
        $this->layout = false;

        return $this->render('forgot-password');
    }
}