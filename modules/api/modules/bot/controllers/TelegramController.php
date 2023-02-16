<?php

namespace app\modules\api\modules\bot\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Request;
use app\modules\api\modules\bot\helpers\LogHelpers;

class TelegramController extends Controller
{
    private $post;
    
    const TOKEN = ''; // Telegram Bot Token;

    public function beforeAction($action)
    {
        date_default_timezone_set('Asia/Jakarta');
        
        $this->enableCsrfValidation = false;

        $request = new Request();
        $this->post = $request->post();

        if (empty($this->post)) {
            $this->post = json_decode(file_get_contents('php://input'), true);
        }

        LogHelpers::log(Yii::$app->params['application_name'], 'Telegram Webhook', json_encode($this->post), null);

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return true;
    }
}