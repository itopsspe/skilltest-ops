<?php
namespace app\widgets;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use app\assets\EditorAsset;

class Editor extends InputWidget
{
    public $clientOptions = [];
    
    public $triggerSaveOnBeforeValidateForm = true;

    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }

        $this->registerClientScript();
    }

    protected function registerClientScript()
    {
        $js = [];
        $view = $this->getView();

        EditorAsset::register($view);

        $id = $this->options['id'];

        $this->clientOptions['selector'] = "#$id";

        $options = Json::encode($this->clientOptions);

        $js[] = "tinymce.init($options);";

        if ($this->triggerSaveOnBeforeValidateForm) {
            $js[] = "$('#{$id}').parents('form').on('beforeValidate', function() { tinymce.triggerSave(); });";
        }

        $view->registerJs(implode("\n", $js));
    }
}
