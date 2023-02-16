<?php

namespace app\modules\admin\modules\employees\controllers;

use app\models\employees\Employees;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class EmployeesController extends Controller
{

    public function actionIndex()
    {
        $employees = Employees::getLists();

        return $this->render('index', [
            'employees' => $employees,
            'titles' => "Employees",
        ]);
    }

    public function actionView($nik)
    {
        $employees = Employees::getDetail($nik);

        if (is_array($employees)) {
            return $this->render('view', [
                'model' => $employees,
            ]);
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
