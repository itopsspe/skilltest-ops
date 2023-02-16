<?php

namespace app\modules\api\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        throw new NotFoundHttpException;
    }
}
