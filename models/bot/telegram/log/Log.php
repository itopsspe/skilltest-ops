<?php

namespace app\models\bot\telegram\log;

use Yii;

/**
 * This is the model class for table "bot_telegram_log".
 *
 * @property int $id
 * @property string|null $room
 * @property string|null $source
 * @property string|null $request
 * @property string|null $response
 * @property string|null $response_datetime
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bot_telegram_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request', 'response'], 'string'],
            [['response_datetime'], 'safe'],
            [['room', 'source'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                => Yii::t('app', 'ID'),
            'room'              => Yii::t('app', 'Room'),
            'source'            => Yii::t('app', 'Source'),
            'request'           => Yii::t('app', 'Request'),
            'response'          => Yii::t('app', 'Response'),
            'response_datetime' => Yii::t('app', 'Response Datetime'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return LogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LogQuery(get_called_class());
    }
}
