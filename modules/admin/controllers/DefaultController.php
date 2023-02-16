<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $this->view->title = "Welcome";
        
        return $this->render('index');
    }
}
