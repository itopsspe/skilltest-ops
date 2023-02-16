<?php

/**
 * @author      David Rivaldy <davidrivaldy@gmail.com>
 * @copyright   2018 | DRAC
 */

namespace app\helpers;

use Yii;
use app\models\setting\maintenance\UnderMaintenance as Maintenance;

class UnderMaintenance
{
    public static function status()
    {
        $maintenance = Maintenance::find()->where(['id' => 1])->one();

        return $maintenance->status;
    }
}