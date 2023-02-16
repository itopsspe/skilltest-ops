<?php

namespace app\modules\api\modules\bot\helpers;

use app\models\bot\telegram\log\Log;

class LogHelpers
{
	public static function log($room, $source, $request, $response)
    {
        $log = new Log;

        $log->setAttributes([
            'room'      => $room,
            'source'    => $source,
            'request'   => $request,
            'response'  => $response
        ]);

        $log->save();
    }
}
  
?>